<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<=2; $i++) {
            $room = new Room();
            $manager->persist($room);
            $this->addReference('room' . $i, $room);
        }

        $manager->flush();
    }
}
