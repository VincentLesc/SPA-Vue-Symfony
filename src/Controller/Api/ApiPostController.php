<?php


namespace App\Controller\Api;


use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiPostController extends AbstractController
{
    private $repository;

    private $serializer;

    /**
     * ApiPostController constructor.
     * @param PostRepository $repository
     * @param SerializerInterface $serializer
     */
    public function __construct(PostRepository $repository, SerializerInterface $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
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
}