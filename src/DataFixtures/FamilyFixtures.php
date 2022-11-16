<?php

namespace App\DataFixtures;

use App\Entity\Family;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FamilyFixtures extends Fixture
{

    const FAMILIES = [
        'doctrine',
        'was',
        'hard',
        'on',
        'me',
        'today'
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (self::FAMILIES as $familyName) {
            $family = new Family();
            $family->setBanner($faker->text());
            $family->setName($familyName);
            $manager->persist($family);
            $this->addReference('family_' . $familyName, $family);
        }

        $manager->flush();
    }
}
