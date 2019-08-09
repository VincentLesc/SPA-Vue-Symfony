<?php


namespace App\Controller\Api;


use App\Entity\UserProfileMedia;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;

class ApiProfileController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/api/user/profile", name="user_profile")
     *
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getUserProfile() {
        $profile = $this->getUser()->getUserProfile();
        $callbackDatetime = function ($innerObject) {
            return $innerObject instanceof \DateTime ? $innerObject->format(\DateTime::ISO8601) : '';
        };
        $callbackFile = function ($filename) {
            return $this->getParameter('public_user_profile_media_directory') . '/' . $filename;
        };
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return [
                    'id' => $object->getId(),
                ];
            },
            AbstractNormalizer::CALLBACKS => [
                'createdAt' => $callbackDatetime,
                'file' => $callbackFile
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
        $data = $serializer->normalize($profile,
            'json', [
                'attributes' => [
                    'id',
                    'userProfileMedia'
                ]
            ]
        );
        $data = $serializer->serialize($data, 'json');

        return $this->json($data);

    }

    /**
     * @Route("/api/profile/media", name="create_profile_media", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function createProfileMedia(Request $request)
    {
        $user = $this->getUser();
        $data = $request->files->get('file');
        $filename = $user->getUsername() . '_' . uniqid(). '.' . $data->guessExtension();
        $control = $data->move(
            $this->getParameter('user_profile_media_directory')  ,
            $filename
        );

        $media = new UserProfileMedia();
        $media->setFile($filename)
            ->setCreatedAt(new \DateTime('now'))
            ->setProfile($this->getUser()->getUserProfile());

        $this->em->persist($media);
        $this->em->flush();


        $callbackDatetime = function ($innerObject) {
            return $innerObject instanceof \DateTime ? $innerObject->format(\DateTime::ISO8601) : '';
        };
        $callbackFile = function ($filename) {
            return $this->getParameter('public_user_profile_media_directory') . '/' . $filename;
        };
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return [
                    'id' => $object->getId(),
                ];
            },
            AbstractNormalizer::CALLBACKS => [
                'createdAt' => $callbackDatetime,
                'file' => $callbackFile
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
        $data = $serializer->normalize($media,
            'json', [
                'attributes' => [
                    'id',
                    'alt',
                    'file'
                ]
            ]
        );
        $data = $serializer->serialize($data, 'json');

        return $this->json($data);
    }

    /**
     * @Route("/api/profile/media/{media}", name="delete_profile_media" ,methods={"DELETE"})
     *
     * @param UserProfileMedia $media
     * @return JsonResponse
     */
    public function deleteProfileMedia(UserProfileMedia $media)
    {
        if ($media->getProfile()->getUser() !== $this->getUser()) {
            return $this->json('Not Allowed', 401);
        };
        $id = $media->getId();
        $filename = $media->getFile();
        $this->em->remove($media);
        $this->em->flush();

        $data = [
            'id' => $id,
            'file' => $filename
        ];

        return $this->json($data, 200);
    }
}
