<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        //User
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setLastName($this->faker->lastName())
                ->setName($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');
            $manager->persist($user);
        }

        $manager->flush();
    }
}