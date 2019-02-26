<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
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
                ->setPassword($faker->word);
                $manager->persist($user);
        }
        $manager->flush();
    }
}
