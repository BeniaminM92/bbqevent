<?php

namespace App\DataFixtures;

use App\Factory\EventFactory;
use App\Factory\LocationFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EventFactory::createMany(30);
        LocationFactory::createMany(15);

        $manager->flush();
    }
}
