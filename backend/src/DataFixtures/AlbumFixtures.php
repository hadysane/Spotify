<?php

namespace App\DataFixtures; 

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Album;

class AlbumFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {

        $album = new Album();
        $album->setName("test");
        $album->setDescription(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis porro, ullam quaerat velit sit esse facere commodi nihil illum unde accusantium necessitatibus deserunt dolore odio rem aperiam nam, excepturi voluptate.");
        $album->setCover("dedez");
        $album->setCoverSmall("ssdsd"); 
        $album->setPopularity(43);
        $album->setReleaseDate(25222);

        $manager->persist($album);

        $manager->flush();


    }
}