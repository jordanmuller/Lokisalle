<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class RoomFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; ++$i) {
            $rand = rand(0, 2);
            $capacity = rand(500, 1500);
            $category = Room::CATEGORIES[$rand];
            
            $cityRand = rand(0, 2);
            $city = Room::CITIES[$cityRand];

            $room = new Room();
            $room
                ->setTitle(Room::CAT_TRANS[$category] . ' ' . ucfirst($faker->word))
                ->setDescription($faker->text(200))
                ->setCountry('France')
                ->setCity($city)
                ->setAddress($faker->address)
                ->setPostalCode((int) $faker->postcode)
                ->setCapacity($capacity)
                ->setCategory($category);
            ;
            $manager->persist($room);
        }
        $manager->flush();
    }
}
