<?php


namespace App\Controller\Api;


use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
     */
    public function getAll()
    {
        $posts = $this->repository->findAll();
        $data = $this->serializer->serialize($posts, 'json');

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
