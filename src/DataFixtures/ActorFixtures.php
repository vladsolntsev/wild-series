<?php


namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


class ActorFixtures extends Fixture implements DependentFixtureInterface
{


   public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('en_US');
        $key = 0;
        for ($i = 0; $i < 50; $i++){
            $actor = new Actor();
            $actor->setName($faker->name);
            $rand2 = rand(1,4);
            for($j = 0; $j < $rand2; $j++){
                $rand = rand (0, 5);
                $actor->addProgram($this->getReference('program_' . $rand));
            }
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
            $key ++;
        }
        $manager->flush();
     }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}