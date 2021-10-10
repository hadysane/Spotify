<?php

namespace App\DataFixtures;

use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Track;

class TrackFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {

        $track = new Track();
        $track->setName("test");
        $track->setTrackNo(1);
        $track->setDuration(5541);
        $track->setMp3("test");
        
        $album = new Album();
        $album = new Album();
        $album->setName("test");
        $album->setDescription(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis porro, ullam quaerat velit sit esse facere commodi nihil illum unde accusantium necessitatibus deserunt dolore odio rem aperiam nam, excepturi voluptate.");
        $album->setCover("dedez");
        $album->setCoverSmall("ssdsd");
        $album->setPopularity(43);
        $album->setReleaseDate(25222);

        $track->setAlbum($album);

        $manager->persist($track);
        $manager->persist($album);

        $manager->flush();


    }
}