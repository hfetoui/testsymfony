<?php

namespace App\Tests;

use App\DataFixtures\AppFixtures;
use App\DataFixtures\EquipementFixtures;
use App\Entity\Equipement;
use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

/**
 * 
 */
class EquipementTest extends KernelTestCase
{

	use FixturesTrait;
	public function testapp()
	{
		self::bootKernel();
		$this->loadFixtures([AppFixtures::class]);
		$equipementcount = self::$container->get(EquipementRepository::class)->count([]);
		$this->assertEquals(5, $equipementcount);
	}

	public function testEquipementEntityWithoutDesc()
	{
		$equipement = (new Equipement())->setName("testEquipementA")->setCategory("Table")->setNumber("RA11A");
		self::bootKernel();
		$errors = self::$container->get("validator")->validate($equipement);
		$this->assertCount(0, $errors);
	}


	public function testEquipementEntityWithoutName()
	{
		$equipement = (new Equipement())->setDescription("testEquipementA Desc")->setCategory("Table")->setNumber("RA11b");
		self::bootKernel();
		$errors = self::$container->get("validator")->validate($equipement);
		$messages = [];
		/**
		 * @var ConstraintViolation $error
		 */
		foreach ($errors as  $error) {

			$messages[] = $error->getPropertyPath() . " --- >" . $error->getMessage();
			// print_r($error->getMessage());
			# code...
		}
		$this->assertCount(1, $errors, implode(' //// ', $messages));
	}


	public function testEquipementEntityWithoutCategory()
	{
		$equipement = (new Equipement())->setName("testEquipementA")->setDescription("testEquipementA Desc")->setNumber("RA11b");
		self::bootKernel();
		$errors = self::$container->get("validator")->validate($equipement);
		$messages = [];
		/**
		 * @var ConstraintViolation $error
		 */
		foreach ($errors as  $error) {

			$messages[] = $error->getPropertyPath() . " --- >" . $error->getMessage();
			// print_r($error->getMessage());
			# code...
		}
		$this->assertCount(1, $errors, implode(' //// ', $messages));
	}

	public function testEquipementEntityWithoutNumber()
	{
		$equipement = (new Equipement())->setName("testEquipementA")->setCategory("Table")->setDescription("testEquipementA Desc");
		self::bootKernel();
		$errors = self::$container->get("validator")->validate($equipement);
		$messages = [];
		/**
		 * @var ConstraintViolation $error
		 */
		foreach ($errors as  $error) {

			$messages[] = $error->getPropertyPath() . " --- >" . $error->getMessage();
			// print_r($error->getMessage());
			# code...
		}
		$this->assertCount(1, $errors, implode(' //// ', $messages));
	}



	public function testaddwithExistingReference()
	{
		self::bootKernel();
		$this->loadFixtures([EquipementFixtures::class]);
		$equipement = (new Equipement())->setName("testEquipementA")->setCategory("Table")->setDescription("testEquipementA Desc")->setNumber("RA11C");
		$errors = self::$container->get("validator")->validate($equipement);
		$this->assertCount(1, $errors);
	}
}
