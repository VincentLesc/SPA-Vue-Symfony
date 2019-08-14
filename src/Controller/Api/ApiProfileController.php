<?php


namespace App\Controller\Api;


use App\Entity\UserProfile;
use App\Entity\UserProfileMedia;
use App\Repository\UserProfileMediaRepository;
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
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
        if (!$this->getUser())
            return new JsonResponse('Not connected', 401);

        $profile = $this->getUser()->getUserProfile();
        $data = $this->__serializer()->normalize($profile,
            'json', [
                'attributes' => [
                    'id',
                    'userProfileMedia',
                    'mainPicture',
                    'title',
                    'description',
                    'age'
                ]
            ]
        );
        $data = $this->__serializer()->serialize($data, 'json');

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
        if (!$this->getUser())
            return new JsonResponse('Not connected', 401);

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

        $data = $this->__serializer()->normalize($media,
            'json', [
                'attributes' => [
                    'id',
                    'file',
                    'isPublic'
                ]
            ]
        );
        $data = $this->__serializer()->serialize($data, 'json');

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
        if (!$this->getUser())
            return new JsonResponse('Not connected', 401);

        if ($media->getProfile()->getUser() !== $this->getUser())
            return $this->json('Not Allowed', 401);

        if ($media->getProfile()->getMainPicture() === $media)
            return $this->json('Not Allowed', 401);


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

    /**
     * @Route("api/profile/media/{media}", name="update_profile_media", methods={"PUT"})
     *
     * @param UserProfileMedia $media
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProfileMedia(UserProfileMedia $media, Request $request)
    {
        if (!$this->getUser())
            return new JsonResponse('Not connected', 401);

        if ($media->getProfile()->getUser() !== $this->getUser())
            return $this->json('Not Allowed', 401);

        $data = json_decode($request->getContent());

        if (isset($data->isPublic)) {
            $media->setIsPublic($data->isPublic);
        }

        $this->em->persist($media);
        $this->em->flush();

        return $this->json($data, 200);
    }

    /**
     * @Route("api/profile/update", name="update_profile", methods={"PUT"})
     * @param Request $request
     * @param UserProfileMediaRepository $mediaRepository
     * @param ValidatorInterface $validator
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function updateProfile(Request $request, UserProfileMediaRepository $mediaRepository, ValidatorInterface $validator)
    {
        if (!$this->getUser())
            return new JsonResponse('Not connected', 401);

        /** @var UserProfile $profile */
        $profile = $this->getUser()->getUserProfile();

        $data = json_decode($request->getContent());
        if (isset($data->mainPicture)) {
            $mainPicture = $mediaRepository->find($data->mainPicture);
            if ( $mainPicture !== $profile->getMainPicture()) {
                $mainPicture = $mediaRepository->find($data->mainPicture);
            } else {
                $mainPicture = null;
            }
            $profile->setMainPicture($mainPicture);
        }
        if (isset($data->title)) {
            $profile->setTitle($data->title);
            $profile->setDescription($data->description);
            $profile->setAge($data->age);
        }
        dump($validator->validate($profile));

        $this->em->persist($profile);
        $this->em->flush();


        $data = $this->__serializer()->normalize($profile,
            'json', [
                'attributes' => [
                    'id',
                    'userProfileMedia',
                    'mainPicture',
                    'title',
                    'description',
                    'age'
                ]
            ]
        );
        $data = $this->__serializer()->serialize($data, 'json');

        return $this->json($data);
    }

    /**
     * @Route("api/profile/all", name="get_all_public_profile", methods={"GET"})
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function getAllPublicProfile()
    {
        $profiles = $this->em->getRepository(UserProfile::class)
            ->findRecentUsers($this->getUser());

        $data = $this->__serializer()->normalize($profiles,
            'json',
            [
                'attributes' => [
                    'id',
                    'mainPicture' => [
                        'file'
                    ]
                ]
            ]
        );
        $data = $this->__serializer()->serialize($data, 'json');

        return $this->json($data);
    }


    /**
     * Set the serializer for Profile Entity
     *
     * @return Serializer
     */
    private function __serializer()
    {
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
        return $serializer = new Serializer([$normalizer], $encoders);
    }
}
