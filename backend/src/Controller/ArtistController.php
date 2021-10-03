<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artist;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


class ArtistController extends AbstractController
{
    /**
     * @Route("/api/artists", name="api_all_artist", methods={"GET"})
     * 
     */
    public function allShow(SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Artist::class);

        $artists = $repository->findAll();

        $json = $serializer->serialize($artists, 'json', [
            'groups' => 'artist:read'
        ]);

        return new JsonResponse($json, 200,  [], true);

    }

    /** 
     * @Route("/api/artists/{id}", name="api_artist", methods={"GET"})
     * 
     */
    public function show(int $id, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Artist::class);

        $artist = $repository->find($id);

        $json = $serializer->serialize($artist, 'json', [
            'groups' => 'artist:read'
        ]);

        return new JsonResponse($json, 200, [], true);
    }
    
}
