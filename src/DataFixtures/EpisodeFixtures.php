<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [
            GotCharacterFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 260; $i++) { 
            $episode = new Episode();
            $episode->setNumber($i);
            // adding 10 random characters per episode
            for ($j=0; $j < 10; $j++) { 
                // we stop at index 499 because we started our loop at 0 in our characters fixtures
                $episode->addGotCharacter($this->getReference('character_' . rand(0,499)));
            }
            $manager->persist($episode);
        }
        $manager->flush();
    }
}
