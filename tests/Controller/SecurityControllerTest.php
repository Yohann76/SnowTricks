<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class securityTest extends WebTestCase {

    public function setUp()
    {

    }

    public function testLogin()
    {
        $client = static::createClient();

        $client->request('GET','/login');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testReset()
    {
        $client = static::createClient();
        $client->request('GET', '/reset');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


}