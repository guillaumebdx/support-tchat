<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USERS = ['Paul', 'Jean', 'Marc', 'Henry', 'Math', 'Guillaume'];

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::USERS as $name) {
            $user = new User();
            $user->setUsername($name);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'azerty'
            ));
            $user->addRoom($this->getReference('room0'))->addRoom($this->getReference('room1'))->addRoom($this->getReference('room2'));
            $manager->persist($user);
            $this->addReference($name, $user);
        }

        $manager->flush();
    }
}
