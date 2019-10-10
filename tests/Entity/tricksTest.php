<?php

namespace App\tests;


use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class tricksTest extends TestCase
{
    private $tricks;

    public function setUp()
    {
        $this->tricks = new tricks;
    }

    public function testTricksName()
    {
        $this->tricks->setName('tricksName');
        $this->assertEquals('tricksName', $this->tricks->getName());
    }

    public function testTricksContent()
    {
        $this->tricks->setContent('tricksContent');
        $this->assertEquals('tricksContent', $this->tricks->getContent());
    }

    public function testTricksDifficulty()
    {
        $this->tricks->setDifficulty(0);
        $this->assertEquals(0, $this->tricks->getDifficulty() );
    }



}