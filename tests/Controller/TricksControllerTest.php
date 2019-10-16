<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class tricksTest extends WebTestCase {

    public function setUp()
    {
    }

    public function testHomepage()
    {
        $client = static::createClient();

        $client->request('GET','/');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testPageNotfound()
    {
        $client = static::createClient();

        $client->request('GET','/admin/hello');
        $this->assertEquals(404,$client->getResponse()->getStatusCode());
    }
}