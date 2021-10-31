<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Album;
use App\Entity\Track;
use App\Repository\AlbumRepository;

class AlbumController extends AbstractController
{
    /**
     * @Route("/api/albums", name="api_albums", methods={"GET"})
     */
    public function all(SerializerInterface $serializer, AlbumRepository $repository)
    {

        $albums = $repository->allAlbum();

        $json = $serializer->serialize($albums, 'json', [
            'groups' => 'album:read'
        ]);

        return new JsonResponse($json, 200, [], true); 


        // $repository = $this->getDoctrine()->getRepository(Album::class);
        // $albums = $repository->findAll();

        // $json = $serializer->serialize($albums, 'json', [
        //     'groups' => 'album:read'
        // ]);

        // return new JsonResponse($json, 200, [], true); 
    }

    /**
     * @Route("/api/albums/{id}", name="api_album", methods={"GET"})
     */
    public function  show(int $id, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Album::class);

        $albums = $repository->find($id);

        $json = $serializer->serialize($albums, 'json', [
            'groups' => ['album-track:read', 'album:read']
        ]);

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/api/albums/artist/{id}", name="api_album-artist", methods={"GET"})
     */
    public function  showArtist(int $id, SerializerInterface $serializer)
    {
        
        $repository = $this->getDoctrine()->getRepository(Album::class);

        $albums = $repository->findBy(array('artist' => $id));

        $json = $serializer->serialize($albums, 'json', [
            'groups' => 'album-artist:read'
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
