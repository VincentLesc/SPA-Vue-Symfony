<?php

namespace App\Controller\Api;

use App\Entity\PostMedia;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class ApiPostController extends AbstractController
{
    private $repository;

    private $serializer;

    private $em;

    private $decoder;

    /**
     * ApiPostController constructor.
     * @param PostRepository $repository
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     */
    public function __construct(PostRepository $repository, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
        $this->em = $em;
        $this->decoder = new JsonDecode();
    }

    /**
     * Return All posts in a Json Response
     * @Route("/api/posts", name="get_all_posts", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getAll(Request $request)
    {
        $offset = $request->getContent();
        $decoder = new JsonDecode();
        $offset = $decoder->decode($offset, 'json')->offset;

        $posts = $this->repository->findAllPostsLazily($offset,18);

        $encoder = new JsonEncoder();
        $callback = function ($innerObject) {
            return $innerObject instanceof \DateTime ? $innerObject->format(\DateTime::ISO8601) : '';
        };
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return [
                    'id' => $object->getId(),
                ];
            },
            AbstractNormalizer::CALLBACKS => [
                'createdAt' => $callback,
            ],
        ];
        $normalizer = new ObjectNormalizer(
            null,
            null,
            null,
            null,
            null,
            null,
            $defaultContext
        );

        $serializer = new Serializer([$normalizer], [$encoder]);
        $data = $serializer->normalize($posts,
            'json', [
                'attributes' => [
                    'id',
                    'title',
                    'content',
                    'createdAt',
                    'author' => [
                        'id',
                        'username'
                    ]
                ]
            ]
        );

        $data = $serializer->serialize($data, 'json');

        return new JsonResponse($data, 200,[], true);
    }


    /**
     * @Route("/api/post", name="create_post", methods={"POST"})
     * @Security("is_granted('ROLE_USER')")
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->getContent();
        $data = $this->serializer->deserialize($data, 'App\Entity\Post', 'json');
        $this->em->persist($data);
        $this->em->flush();

        return new JsonResponse('success', 200);
    }

    /**
     * @Route("/api/post/media", name="create_post_media", methods={"POST"})
     * @Security("is_granted('ROLE_USER')")
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     * @throws ExceptionInterface
     */
    public function createPostMedia(Request $request)
    {
        $user = $this->getUser();
        $data = $request->files->get('file');
        $filename = $user->getUsername() . '_' . uniqid(). '.' . $data->guessExtension();
        $data->move(
            $this->getParameter('post_media_directory')  ,
            $filename
        );

        $media = new PostMedia();
        dump($request->request->get('alt'));
        $media->setFile($filename)
            ->setAlt($request->request->get('alt'))
            ->setCreatedAt(new \DateTime('now'))
            ->setUploadedBy($this->getUser());

        $this->em->persist($media);
        $this->em->flush();


        $callback = function ($innerObject) {
            return $innerObject instanceof \DateTime ? $innerObject->format(\DateTime::ISO8601) : '';
        };
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return [
                    'id' => $object->getId(),
                ];
            },
            AbstractNormalizer::CALLBACKS => [
                'createdAt' => $callback,
            ],
        ];
        $encoders = [new JsonEncoder()];
        $normalizer = new ObjectNormalizer(
            null,
            null,
            null,
            null,
            null,
            null,
            $defaultContext
        );
        $serializer = new Serializer([$normalizer], $encoders);
        $jsonObject = $serializer->serialize($media, 'json');


        $data = $serializer->normalize($jsonObject,
            'json', [
                'attributes' => [
                    'id',
                    'alt',
                    'file'
                ]
            ]
        );

        return new JsonResponse($data, 200);
    }
}
