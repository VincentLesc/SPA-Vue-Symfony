<?php

namespace App\Controller\Api;

use App\Entity\AppEntity\CommunityGroup;
use App\Entity\AppEntity\Ethnicity;
use App\Entity\AppEntity\MaritalStatus;
use App\Entity\AppEntity\Morphology;
use App\Entity\AppEntity\SexualPosition;
use App\Repository\AppEntity\CommunityGroupRepository;
use App\Repository\AppEntity\EthnicityRepository;
use App\Repository\AppEntity\MaritalStatusRepository;
use App\Repository\AppEntity\MorphologyRepository;
use App\Repository\AppEntity\SexualPositionRepository;
use App\Service\App\AppCache;
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
     * @param AppCache $appCache
     * @param CommunityGroupRepository $communityGroupRepository
     * @param MaritalStatusRepository $maritalStatusRepository
     * @param EthnicityRepository $ethnicityRepository
     * @param MorphologyRepository $morphologyRepository
     * @param SexualPositionRepository $sexualPositionRepository
     * @return JsonResponse
     */
    public function appParameters(
        AppCache $appCache,
        CommunityGroupRepository $communityGroupRepository,
        MaritalStatusRepository $maritalStatusRepository,
        EthnicityRepository $ethnicityRepository,
        MorphologyRepository $morphologyRepository,
        SexualPositionRepository $sexualPositionRepository
    )
    {
        $groups = $appCache->getAppCachedGlobalEntity($communityGroupRepository, 'group');
        $maritalStatus = $appCache->getAppCachedGlobalEntity($maritalStatusRepository, 'marital-status');
        $ethnicity = $appCache->getAppCachedGlobalEntity($ethnicityRepository, 'ethnicity');
        $morphology = $appCache->getAppCachedGlobalEntity($morphologyRepository, 'morphology');
        $sexualPosition = $appCache->getAppCachedGlobalEntity($sexualPositionRepository, 'sexual-position');

        $dataGroups = $this->__serializer()->serialize($groups, 'json');
        $dataMaritalStatus = $this->__serializer()->serialize($maritalStatus, 'json');
        $dataEthnicityStatus = $this->__serializer()->serialize($ethnicity, 'json');
        $dataMorphology = $this->__serializer()->serialize($morphology, 'json');
        $dataSexualPosition = $this->__serializer()->serialize($sexualPosition, 'json');

        return $this->json([
            'groups' => $dataGroups,
            'maritalStatus' => $dataMaritalStatus,
            'ethnicity' => $dataEthnicityStatus,
            'morphology' => $dataMorphology,
            'sexualPosition' => $dataSexualPosition
        ], 200);

    }

    private function __serializer()
    {
        $encoders = [new JsonEncoder()];
        $normalizer = [new ObjectNormalizer()];
        return $serializer = new Serializer($normalizer, $encoders);
    }
}
