<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    public const MESSAGES = [
        'Salut',
        'slt',
        'ça va ?',
        'Salut tout le monde',
        'hello',
        'Comment ça va ?',
        'coucou',
        'wsh',
        'Bonjour à tous',
        'hi !',
        'Bjr',
        'guten tag',
    ];
    public function load(ObjectManager $manager)
    {
        $messages = self::MESSAGES;
        $users = UserFixtures::USERS;
        for ($i=0; $i<=20; $i++) {
            $message = new Message();
            $message->setContent($messages[rand(0, count($messages)-1)]);
            $message->setUser($this->getReference($users[rand(0, count($users)-1)]));
            $message->setRoom($this->getReference('room' . rand(0,2)));

            $manager->persist($message);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            RoomFixtures::class,
        ];
    }


}
