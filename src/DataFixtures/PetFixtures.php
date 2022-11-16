<?php

namespace App\DataFixtures;

use App\Entity\Pet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PetFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [
            GotCharacterFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for ($i=0; $i < 200; $i++) { 
            $pet = new Pet();
            $pet->setName($faker->name());
            // we stop at index 499 because we started our loop at 0 in our characters fixtures
            $pet->setGotCharacter($this->getReference('character_' . rand(0, 499)));
            $manager->persist($pet);
        }

        $manager->flush();
    }
}
