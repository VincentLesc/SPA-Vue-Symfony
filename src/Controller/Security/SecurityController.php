<?php

namespace App\Controller\Security;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
