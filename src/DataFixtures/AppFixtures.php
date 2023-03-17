<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Meal;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
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
        //Admin
        $admin = new User();
        $admin->setName('Quai ')
            ->setLastName(' Antique')
            ->setEmail('admin@quaiantique.fr')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPlainPassword('password');
        $users[] = $admin;
        $manager->persist($admin);

        //User
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setLastName($this->faker->lastName())
                ->setName($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password')
                ->setNbrOfCoversByDefault(mt_rand(0, 1) == 1 ? mt_rand(1, 8) : null);
            $users[] = $user;
            $manager->persist($user);
        }

        //Category
        $categories = [];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($this->faker->city());
            $categories[] = $category;
            $manager->persist($category);
        }

        //Meal
        $meals = [];
        foreach ($categories as $category) {
            for ($repast = 0; $repast < 6; $repast++) {
                $meal = new Meal();
                $meal->setTitle($this->faker->words(3, true))
                    ->setDescription($this->faker->paragraph())
                    ->setPrice($this->faker->randomFloat(1, 7, 22))
                    ->addCategory($categories[mt_rand(0, count($categories) - 1)]);
                $meals[] = $meal;
                $manager->persist($meal);
            }
        }

        $manager->flush();
    }
}
