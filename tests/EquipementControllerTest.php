<?php

namespace App\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\EquipementFixtures;

/**
 * 
 */
class EquipementControllerTest extends WebTestCase
{

	
    public function testSitehomeRedirect()
    {
        $client = $this->createClient([], ['HTTP_HOST' => 'localhost:8099']);
        $crawler = $client->request('GET', '/');
        $this->assertResponseRedirects("/equipements/");
    }

	use FixturesTrait;

    public function testSiteFonctionequipementslist()
    {
        $client = $this->createClient([], ['HTTP_HOST' => 'localhost:8099']);


        $this->loadFixtures([AppFixtures::class]);

        $crawler = $client->request('GET', '/equipements/');
        $this->assertStatusCode(200, $client);

    	// Vérifie qu'il y a un tableau dans la page

    	$this->assertTrue($crawler->filter('table')->count() == 1);

    	// Vérifie qu'il y a un 5 Equippements dans la page

    	$this->assertTrue($crawler->filter('table tbody tr')->count() == 5);

    }


    public function testSiteFonctionequipementAdd()
    {
        $client = $this->createClient([], ['HTTP_HOST' => 'localhost:8099']);


        $this->loadFixtures([AppFixtures::class]);

        $crawler = $client->request('GET', '/equipements/new');
        $this->assertStatusCode(200, $client);


        $form = $crawler->selectButton("Envoyer")->form([
        	"equipement[name]"=>"mytestEq",
        	"equipement[category]" => "Table",
        	"equipement[number]" => "FA00NEW",
        	"equipement[description]"=>"description de test"
        ]);

        $client->submit($form);

			// Vérifie qu'il y a une Redirection vers la liste des equipements
        $this->assertResponseRedirects("/equipements/");

        $client->followRedirect();

		$crawler = $client->getCrawler();

    	// Vérifie qu'il y a un tableau dans la page

    	$this->assertTrue($crawler->filter('table')->count() == 1);

    }
}
