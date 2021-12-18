<?php
declare(strict_types=1);

namespace App\tests\Func;

use App\Entity\Article;
use App\Entity\User;
use Faker\Factory;
use PhpParser\Builder\Method;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;
Class UseTest extends AbstractEndPoint
{
    private string $userPayload = '{"email":"%S", "password":"password"}';
    public function testGetUsers():void
    {
     
        
         $response=$this->GetResponseFromRequest(Request::METHOD_GET,'/api/users');
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

         self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);


    }

    public function testPostUsers():void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_POST,
             '/api/users',
             $this->getPayload()
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

         dd($responseDecoded);
         self::assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);

         
    }

    private function getPayload():string
    {
        $faker=Factory::create();
        return sprintf($this->userPayload,$faker->email);
    }

   

}