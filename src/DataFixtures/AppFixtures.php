<?php

namespace App\DataFixtures;

use App\Entity\VideoGame;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private static $genres = [
        'action',
        'adventure',
        'quest',
        'rpg',
        'strategy',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $videogame = new VideoGame();
            $videogame->setName($faker->word);
            $videogame->setDeveloper($faker->company);
            $videogame->setGenres($faker->randomElements(self::$genres, rand(1,3)));
            $manager->persist($videogame);
        }

        $manager->flush();
    }
}
