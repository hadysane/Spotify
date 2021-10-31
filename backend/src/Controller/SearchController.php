<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Album;
use App\Entity\Track;
use App\Entity\Artist;
use App\Entity\Genre;

class SearchController extends AbstractController
{
    /**
     * @Route("/api/search/album/{name}", name="search_album")
     */
    public function searchAlbum(string $name, SerializerInterface $serializer )
    {
        $repository = $this->getDoctrine()->getRepository(Album::class);
        $albums = $repository->findBy(array('name' => $name));

        $json = $serializer->serialize($albums, 'json', [
            'groups' => ['album-track:read', 'album:read']
        ]);

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/api/search/track/{name}", name="search_track")
     */
    public function searchTrack(string $name, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Track::class);
        $tracks = $repository->findBy(array('name' => $name));

        $json = $serializer->serialize($tracks, 'json', [
            'groups' => 'track:read',
        ]);

        return new JsonResponse($json, 200, [], true);

    }

    /**
     * @Route("/api/search/artist/{name}", name="search_artist")
     */
    public function searchArtist(string $name, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Artist::class);
        $artist = $repository->findBy(array('name' => $name));

        $json = $serializer->serialize($artist, 'json', [
            'groups' => 'artist:read', 
        ]);

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/api/search/genre/{name}", name="search_genre")
     */
    public function searchGenre(string $name, SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Genre::class);
        $genre = $repository->findBy(array('name' => $name));

        $json = $serializer->serialize($genre, 'json', [
            'groups' => 'genre:read'
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
