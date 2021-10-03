<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Track;


class TrackController extends AbstractController
{
    /**
     * @Route("/api/track/{id}", name="api_track", methods={"GET"})
     */
    public function show(int $id, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Track::class);

        $track = $repository->find($id);

        $json = $serializer->serialize($track, 'json', [
            'groups' => 'track:read'
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
