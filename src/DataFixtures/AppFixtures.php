<?php

namespace App\DataFixtures;

use App\Entity\Developer;
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
            $developer = new Developer();
            $developer->setName($faker->company);

            $videogame = new VideoGame();
            $videogame->setName($faker->word);
            $videogame->setDeveloper($developer);
            $videogame->setStatus($faker->word);
            $videogame->setGenres($faker->randomElements(self::$genres, rand(1,3)));

            $manager->persist($developer);
            $manager->persist($videogame);
        }

        $manager->flush();
    }
}
