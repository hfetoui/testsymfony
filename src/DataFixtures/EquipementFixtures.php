<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Equipement;

class EquipementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $equipement = (new Equipement())->setName("testEquipement")->setCategory("Table")->setNumber("RA11C");
        $manager->persist($equipement);
        $manager->flush();
    }
}
