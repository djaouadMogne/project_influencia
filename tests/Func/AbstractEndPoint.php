<?php
declare(strict_types=1);

namespace App\tests\Func;

use App\DataFixtures\AppFixtures;
use App\Entity\Article;
use App\Entity\User;
use PhpParser\Builder\Method;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;

abstract Class AbstractEndPoint extends WebTestCase
{ 
    protected array  $serverInformation=['ACCEPT'=>'application/json', 'CONTENT_TYPE'=>'application/json'];
    protected string  $tokenNotFound="JWT Token not found";
    protected string  $notYourResource="It's not your resource";
    protected  string $loginPayload='{"username": "$s","password":"%s" }';

    public function GetResponseFromRequest(string $method,string $uri,string $payload='',array $parameter=[],bool $withAuthentification=true):Response
    {
     
       
         $client= $this->createAuthentificationClient($withAuthentification);
         $client->request(
             $method,
             $uri . 'json',
             $parameter,
             [], 
             $this->serverInformation,
            $payload
               
            );
         return $client->getResponse();
    }

    protected function createAuthentificationClient(bool $withAuthentification):KernelBrowser
    {
        $client= static::createClient();

        if(!$withAuthentification)
        {
            return $client;
        }
        $client->request(
            Request::METHOD_POST,
            '/api/login_check',
            [],
            [], 
            $this->serverInformation,
           sprintf($this->loginPayload,AppFixtures::DEFAULT_USER['email'],AppFixtures::DEFAULT_USER['password'])
              
           );
       $data =json_decode($client->getResponse()->getContent(), true);
       $client->setServerParameter('HTTP_Authorization',sprintf('Bearer $s',$data['token']));
       return $client;
    }
   

}