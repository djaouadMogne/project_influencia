<?php
declare(strict_types=1);

namespace App\tests\Func;

use App\DataFixtures\AppFixtures;
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
     
        
         $response=$this->GetResponseFromRequest(Request::METHOD_GET,'/api/users','',[],false);
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
             $this->getPayload(),
            [],
            false
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

        
         self::assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);

         
    }
    public function testGetDefaultUser(): int
    {
        $response=$this->GetResponseFromRequest(Request::METHOD_GET,'/api/users','',["email"=>AppFixtures::DEFAULT_USER['email']],false);
        $responseContent=$response->getContent();
        $responseDecoded=json_decode($responseContent,true);

        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);

        return $responseDecoded[0]['id'];
    }

    /**
     * @depends tstGetDefaultUser
     */
    public function testPutDefaultUsers(int $id):void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_PUT,
             '/api/users/' . $id,
             $this->getPayload(),
            [],
            false
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

        
         self::assertEquals(Response::HTTP_UNAUTHORIZED,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);

         
    }

      /**
     * @depends tstGetDefaultUser
     */
    public function testPatchDefaultUsers(int $id):void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_PATCH,
             '/api/users/' . $id,
             $this->getPayload(),
            [],
            false
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

        
         self::assertEquals(Response::HTTP_UNAUTHORIZED,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);

         
    }
          /**
     * @depends tstGetDefaultUser
     */
    public function testDeleteDefaultUsers(int $id):void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_DELETE,
             '/api/users/' . $id,
             $this->getPayload(),
            [],
            false
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

        
         self::assertEquals(Response::HTTP_UNAUTHORIZED,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);

         
    }
              /**
     * @depends testPostUser
     */
    public function testDeleteOtherUserWithJWT(int $id):void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_DELETE,
             '/api/users/' . $id,
             $this->getPayload(),
            [],
            true
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent,true);

        
         self::assertEquals(Response::HTTP_UNAUTHORIZED,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);
         self::assertEquals($this->notYourResource,$responseDecoded['message']);

         
    }

                 /**
     * @depends testGetDefaultUser
     */
    public function testDeleteDefaultUserWithJWT(int $id):void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_DELETE,
             '/api/users/' . $id,
             $this->getPayload(),
            [],
            true
            );

        

        
         self::assertEquals(Response::HTTP_NO_CONTENT,$response->getStatusCode());
   

         
    }

    public function testPostDefaultUsers():void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_POST,
             '/api/users',
            json_encode(AppFixtures::DEFAULT_USER),
            [],
            false
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

        
         self::assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);

         
    }

    public function testPostSameDefaultUsers():void
    {
     
        
         $response=$this->GetResponseFromRequest(
             Request::METHOD_POST,
             '/api/users',
            json_encode(AppFixtures::DEFAULT_USER),
            [],
            false
            );
         $responseContent=$response->getContent();
         $responseDecoded=json_decode($responseContent);

        
         self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
         self::assertJson($responseContent);
         self::assertNotEmpty($responseDecoded);

         
    }
    private function getPayload():string
    {
        $faker=Factory::create();
        return sprintf($this->userPayload,$faker->email);
    }

   

}