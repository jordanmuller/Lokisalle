<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Room;
use App\Entity\User;
use App\Entity\Opinion;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public const USER_REF = 'user';

    public const ROOM_REF = 'room';

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user
            ->setEmail('test@gmail.com')
            ->setFirstName('Test')
            ->setName('Testy')
            ->setCivility('m')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($user, 'test'))
        ;
        $manager->persist($user);
        $this->addReference(self::USER_REF, $user);

        $user = new User();
        $user
            ->setEmail('admin@gmail.com')
            ->setFirstName('Admin')
            ->setName('Adminy')
            ->setCivility('f')
            ->setRoles(['ROLE_UPER_ADMIN'])
            ->setPassword($this->encoder->encodePassword($user, 'admin'))
        ;
        $manager->persist($user);

        for ($i = 0; $i < 100; $i++) {
            $rand = rand(0, 1); 
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setFirstName($faker->firstName)
                ->setName($faker->lastName)
                ->setCivility(User::CIVILITIES[$rand])
                ->setPassword($faker->word)
            ;
            $manager->persist($user);
        }

        $rand = rand(0, 2);
        $capacity = rand(500, 1500);
        $category = Room::CATEGORIES[$rand];
        
        $cityRand = rand(0, 2);
        $city = Room::CITIES[$cityRand];

        $room = new Room();
        $room
            ->setTitle('ROOM TEST')
            ->setDescription($faker->text(200))
            ->setCountry('France')
            ->setCity($city)
            ->setAddress($faker->address)
            ->setPostalCode((int) $faker->postcode)
            ->setCapacity($capacity)
            ->setCategory($category);
        ;
        $manager->persist($room);
        $this->addReference(self::ROOM_REF, $room);

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
