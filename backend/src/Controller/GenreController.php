<?php

namespace App\Controller;

use App\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class GenreController extends AbstractController
{
    /**
     * @Route("/api/genres", name="api_genre_all", methods={"GET"})
     */
    public function index(SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Genre::class);

        $genres = $repository->findAll();

        $json = $serializer->serialize($genres, 'json', [
            'groups' => 'genre:read'
        ]);

        return new JsonResponse($json, 200, [], true); 
    }

    /**
     * @Route("/api/genres/{id}", name="api_genre", methods={"GET"})
     */
    public function show(int $id ,SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Genre::class);

        $genre = $repository->find($id);

        $json = $serializer->serialize($genre, 'json', [
            'groups' => 'album_genre:read'
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
