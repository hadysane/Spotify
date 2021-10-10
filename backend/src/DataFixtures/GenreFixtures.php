<?php

namespace App\DataFixtures; 

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Genre;

class GenreFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {

        $genre = new Genre();
        $genre->setName("test");

        $manager->persist($genre);
        $manager->flush();


    }
}