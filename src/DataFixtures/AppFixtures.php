<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Equipement;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $equipement = (new Equipement())->setName("testEquipement$i")->setCategory($i % 2 ? "Table" : "Ordinateur")->setNumber("RA11$i");
            $manager->persist($equipement);
        }
        $manager->flush();
    }
}
