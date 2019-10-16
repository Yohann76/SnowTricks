<?php

namespace App\tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class userTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }
    // bon
    public function testUserFirstName()
    {
        $this->user->setFirstName('Yohann');
        $this->assertEquals('Yohann', $this->user->getFirstName());
    }

    // pas bon
    public function testUserEmail()
    {
        $this->user->setEmail('yohanndurand76@gmail.com');
        $this->assertEquals('yohanndurand76@gmail.com', $this->user->getEmail());
    }
    // bon
    public function testUserPicture()
    {
        $this->user->setPicture('yohann.jpg');
        $this->assertEquals('yohann.jpg', $this->user->getPicture() );
    }



}