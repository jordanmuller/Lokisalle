<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Room;
use App\Entity\User;
use App\Entity\Opinion;
use App\DataFixtures\AppFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OpinionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 1000; $i++) {
            $opinion = new Opinion();
            $mark = rand(0, 5);
            $id = rand(0, 100);
            $room = $manager->getRepository(Room::class)->findOneBy(['id' => $id]);

            $opinion
                ->setComment($faker->text(200))
                ->setMark($mark)
                ->setRoom($this->getReference(AppFixtures::ROOM_REF))
                ->setUser($this->getReference(AppFixtures::USER_REF));
            ;
            $manager->persist($opinion);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AppFixtures::class];
    }
}
