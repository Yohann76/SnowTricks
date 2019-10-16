<?php

namespace App\tests;

use App\Entity\Comment;
use PHPUnit\Framework\TestCase;

class commentTest extends TestCase
{
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment();
    }

    public function testCommentContent()
    {
        $this->comment->setContent('commentContent');
        $this->assertEquals('commentContent', $this->comment->getContent() );
    }
}