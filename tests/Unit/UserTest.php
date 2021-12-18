<?php
declare(strict_types=1);

namespace App\tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

Class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user= new User();

    }
   
    public function testGetEmail():void
    {
        $value='theEmail@test.fr';
        $response= $this->user->setEmail($value);

        self::assertInstanceOf('App\Entity\User',$response);
        self::assertEquals($value,$this->user->getEmail());


    }
    
    public function testGetRoles():void
    {
        $value=['ROLE_ADMIN'];
  
        $response=$this->user->setRoles($value);
       
        self::assertInstanceOf('App\Entity\User',$response);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());


    }

    public function testGetPassword():void
    {
        $value="MyPasswordIntelligente";

        $response=$this->user->setPassword($value);
       self::assertInstanceOf('App\Entity\User' ,$response);
 


    }

    public function testGetArticle():void
    {
        $value=new Article();

        $response=$this->user->addArticle($value);
       self::assertInstanceOf('App\Entity\User' ,$response);
       self::assertCount(1,$this->user->getArticles());
       self::assertTrue($this->user->getArticles()->contains($value));

       $response=$this->user->removeArticle($value);
       
       self::assertInstanceOf('App\Entity\User' ,$response);
       self::assertCount(0,$this->user->getArticles());
       self::assertFalse($this->user->getArticles()->contains($value));
    }



}