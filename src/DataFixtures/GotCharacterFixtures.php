<?php

namespace App\DataFixtures;

use App\Entity\GotCharacter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GotCharacterFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [
            FamilyFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0; $i < 500; $i++) { 
            $character = new GotCharacter();
            $character->setFirstName($faker->firstName());
            $character->setFamily($this->getReference(
                'family_' . FamilyFixtures::FAMILIES[rand(0, count(FamilyFixtures::FAMILIES) - 1)]
            ));
            $character->setLastName($character->getFamily()->getName());
            $manager->persist($character);
        }
        $manager->flush();
    }
}
