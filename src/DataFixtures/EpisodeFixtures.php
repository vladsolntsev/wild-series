<?php


namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        $key = 0;
        for ($i = 0; $i < 500; $i++){
            $seasonKey = rand(1,49);
            $episode = new Episode();
            $episode->setTitle($faker->name);
            $episode->setNumber($faker->randomNumber());
            $episode->setSynopsis($faker->text());
            $episode->setSeason($this->getReference('season_' . $seasonKey));
            $manager->persist($episode);
            $this->addReference('episode_' . $key, $episode);
            $key ++;
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}