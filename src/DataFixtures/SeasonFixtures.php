<?php


namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('en_US');
        $key = 0;
        for ($i = 0; $i < 50; $i++){
            $rand = rand (0, 5);
            $season = new Season();
            $season->setNumber($faker->randomNumber());
            $season->setYear($faker->year());
            $season->setDescription(($faker->text));
            $season->setProgram($this->getReference('program_' . $rand));
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
            $key ++;
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}