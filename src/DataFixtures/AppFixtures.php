<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Meals;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
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
        $users = [];

        $admin = new User();
        $admin
            ->setLastName($this->faker->lastName())
            ->setName($this->faker->firstName())
            ->setEmail('admin@quaiAntique.fr')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPlainPassword('password');

        $users[] = $admin;
        $manager->persist($admin);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setLastName($this->faker->lastName())
                ->setName($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');

            $users[] = $user;
            $manager->persist($user);
        }

        //Categories
        $category = [];
        for ($i = 0; $i < 5; $i++) {
            $categories = new Categories();
            $categories->setName($this->faker->city());

            $category[] = $categories;
            $manager->persist($categories);
        }

        //Meals
        $meal = [];
        foreach ($category as $categories) {
            for ($repast = 0; $repast < 5; $repast++) {
                $meals = new Meals();
                $meals->setTitle($this->faker->words(3, true))
                    ->setDescription($this->faker->paragraph())
                    ->setPrice($this->faker->randomFloat(1, 7, 22))
                    ->addCategory($category[mt_rand(0, count($category) - 1)]);

                $meal[] = $meals;
                $manager->persist($meals);
            }
        }


        $manager->flush();
    }
}
