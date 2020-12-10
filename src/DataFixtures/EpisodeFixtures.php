<?php


namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        $key = 0;
        $seasonKey = 0;
        for ($i = 0; $i < 300; $i++){
            $seasonKey = rand(0,30);
            $episode = new Episode();
            $episode->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true) );
            $slugTitle = $this->slugify->generate($episode->getTitle());
            $episode->setSlug($slugTitle);
            $episode->setNumber($faker->randomNumber(2));
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