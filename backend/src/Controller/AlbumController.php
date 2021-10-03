<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Album;
use App\Entity\Track;

class AlbumController extends AbstractController
{
    /**
     * @Route("/api/albums", name="api_albums", methods={"GET"})
     */
    public function all(SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Album::class);

        $albums = $repository->findAll();

        $json = $serializer->serialize($albums, 'json', [
            'groups' => 'album:read'
        ]);

        return new JsonResponse($json, 200, [], true); 
    }

    /**
     * @Route("/api/albums/{id}", name="api_album", methods={"GET"})
     */
    public function  show(int $id, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Album::class);

        $albums = $repository->find($id);

        $json = $serializer->serialize($albums, 'json', [
            'groups' => 'album:read'
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
