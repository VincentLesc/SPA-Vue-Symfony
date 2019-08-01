<?php


namespace App\Controller\Api;


use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiPostController extends AbstractController
{
    private $repository;

    private $serializer;

    private $em;

    /**
     * ApiPostController constructor.
     * @param PostRepository $repository
     * @param SerializerInterface $serializer
     */
    public function __construct(PostRepository $repository, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
        $this->em = $em;
    }

    /**
     * Return All posts in a Json Response
     * @Route("/api/posts", name="get_all_posts", methods={"GET"})
     * @return JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function getAll()
    {
        $posts = $this->repository->findBy([],['createdAt'=> 'DESC']);
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
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $data = $serializer->normalize($posts,
            'json', [
                'attributes' => [
                    'title',
                    'content',
                    'createdAt',
                    'author' => [
                        'id',
                        'username',
                        'posts'
                    ]
                ]
            ]
        );

        $data = $serializer->serialize($data, 'json');

        return new JsonResponse($data, 200,[], true);
    }


    /**
     * @Route("/api/post", name="create_post", methods={"POST"})
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
}
