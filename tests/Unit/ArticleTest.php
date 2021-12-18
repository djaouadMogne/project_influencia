<?php

declare(strict_types=1);

namespace App\tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

Class ArticleTest extends TestCase
{
    private Article $article;

    protected function setUp(): void
    {
        parent::setUp();
        $this->article= new Article();

    }
   
    public function testGetName():void
    {
        $value="TheUltimeTitle";
        $reponse= $this->article->setName($value);
        

        self::assertInstanceOf("App\Entity\Article" ,$reponse);
        self::assertEquals($value,$this->article->getName());


    }
    
    public function testGetContent():void
    {
        $value="hjklkjhgfveg";

        $response=$this->article->setContent($value);
        self::assertInstanceOf("App\Entity\Article",$response);


    }

    public function testGetAuthor():void
    {
        $value=new User();

        $response=$this->article->setAuthor($value);
        self::assertInstanceOf("App\Entity\Article",$response);
        self::assertEquals($value,$this->article->getAuthor());
    }
}