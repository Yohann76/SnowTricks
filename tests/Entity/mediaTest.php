<?php

namespace App\tests;


use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class mediaTest extends TestCase
{
    private $media;

    public function setUp()
    {
        $this->media = new media;
    }

    public function testmediaPath()
    {
        $this->media->setPath('Media/01.jpg');
        $this->assertEquals('Media/01.jpg', $this->media->getPath());
    }

    public function testmediaText()
    {
        $this->media->setText('mediaText');
        $this->assertEquals('mediaText', $this->media->getText());
    }

    public function testmediaThumbnail()
    {
        $this->media->setthumbnail(0);
        $this->assertEquals(0, $this->media->getThumbnail() );
    }



}