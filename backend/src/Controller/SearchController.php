<?php

namespace App\Controller;


use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\GenreRepository;
use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/api/search/album", name="search_album", methods={"GET"})
     */
    public function searchAlbum(Request $request, SerializerInterface $serializer, AlbumRepository $repository)
     {
        $name = $request->query->get('name');

        if($name === ''){
            return new JsonResponse([
                'error' => 'search is empty'
            ], 401);
        }
      
        
        $albums = $repository->findTitle($name);

        $json = $serializer->serialize($albums, 'json', [
            'groups' => ['album:read']
        ]);

        

        return new JsonResponse($json, 200, [], true); 
    }

    /**
     * @Route("/api/search/track", name="search_track", methods={"GET"})
     */
    public function searchTrack(Request $request, SerializerInterface $serializer, TrackRepository $repository)
    {
        $name = $request->query->get('name');

        if ($name === '') {
            return new JsonResponse([
                'error' => 'search is empty'
            ], 401);
        }

        $tracks = $repository->findTitle($name);

        $json = $serializer->serialize($tracks, 'json', [
            'groups' => 'track:read',
        ]);

        return new JsonResponse($json, 200, [], true);

    }

    /**
     * @Route("/api/search/artist", name="search_artist", methods={"GET"})
     */
    public function searchArtist(Request $request, SerializerInterface $serializer, ArtistRepository $repository)
    {
        $name = $request->query->get('name');

        if ($name === '') {
            return new JsonResponse([
                'error' => 'search is empty'
            ], 401);
        }

        $artist = $repository->findTitle($name);

        $json = $serializer->serialize($artist, 'json', [
            'groups' => 'artist:read', 
        ]);

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/api/search/genre/", name="search_genre", methods={"GET"})
     */
    public function searchGenre(Request $request, SerializerInterface $serializer, GenreRepository $repository)
    {
        $name = $request->query->get('name');

        if ($name === '') {
            return new JsonResponse([
                'error' => 'search is empty'
            ], 401);
        }

        $genre = $repository->findName($name);

        $json = $serializer->serialize($genre, 'json', [
            'groups' => 'genre:read',
        ]);

        return new JsonResponse($json, 200, [], true);
    }
}
