<?php

namespace App\Controller\Api;

use App\Entity\AppEntity\CommunityGroup;
use App\Entity\AppEntity\MaritalStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

Class ApiAppGlobalController extends AbstractController
{

    /**
     * @Route("/api/app/params", name="app_params", methods={"GET"})
     * @return JsonResponse
     */
    public function appParameters()
    {
        $groups = $this->getDoctrine()->getRepository(CommunityGroup::class)->findAll();
        $maritalStatus = $this->getDoctrine()->getRepository(MaritalStatus::class)->findAll();

        $dataGroups = $this->__serializer()->serialize($groups, 'json');
        $dataMaritalStatus = $this->__serializer()->serialize($maritalStatus, 'json');

        return $this->json([
            'groups' => $dataGroups,
            'maritalStatus' => $dataMaritalStatus
        ], 200);

    }

    private function __serializer()
    {
        $encoders = [new JsonEncoder()];
        $normalizer = [new ObjectNormalizer()];
        return $serializer = new Serializer($normalizer, $encoders);
    }
}