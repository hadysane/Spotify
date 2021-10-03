<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Artist;


class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $artist = new Artist();
        $artist->setName("A_Rival");
        $artist->setDescription("chip-hop defined...electronic rap at its rawest");
        $artist->setBio("Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum quam iste explicabo! Inventore, consequuntur hic sunt facilis doloremque repellat impedit sed dolore, harum fuga nihil excepturi, quaerat dignissimos dolorem reiciendis?"); 
        $artist->setPhoto("http://magnatune.com/artists/img/a_rival.jpg");

        $manager->persist($artist);

        $manager->flush();
        
    }
}
