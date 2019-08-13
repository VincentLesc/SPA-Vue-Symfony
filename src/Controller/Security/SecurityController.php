<?php

namespace App\Controller\Security;

use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validation;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="login", methods={"POST"})
     */
    public function login()
    {
        $user = $this->getUser();

        return $this->json([
            'roles' => $user->getRoles(),
            'username' => $user->getUsername()
        ]);
    }

    /**
     * @Route("/api/register", name="register", methods={"POST"})
     * @param Request $request
     * @param ObjectManager $em
     * @return JsonResponse
     */
    public function register(Request $request, ObjectManager $em)
    {
        $data = $request->getContent();
        $encoders = [new JsonEncoder()];
        $normalizer = new ObjectNormalizer();

        $serializer = new Serializer([$normalizer], $encoders);

        $user = $serializer->deserialize($data, 'App\Entity\User', 'json');

        $em->persist($user);
        $em->flush();


        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
        $this->container->get('session')->set('_security_main', serialize($token));

        $data = $serializer->serialize($user, 'json');

        return new JsonResponse($data, 200);
    }

    /**
     * @Route("/api/logout", name="logout")
     * @return void
     * @throws \RuntimeException
     */
    public function logout(): void
    {
        throw new \RuntimeException('This should not be reached!');
    }

    /**
     * @Route("/api/security/control", name="security_email_control")
     * @param Request $request
     * @param UserRepository $repository
     * @return JsonResponse
     */
    public function isUniqueEmail(Request $request ,UserRepository $repository)
    {
        $email = json_decode($request->getContent())->email;
        $user = $repository->findOneBy(['email' => $email]);
        $data = $user ? false : true;
        return $this->json($data);
    }
}
