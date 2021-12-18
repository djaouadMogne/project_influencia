<?php
declare(strict_types=1);

namespace App\tests\Func;

use App\Entity\Article;
use App\Entity\User;
use PhpParser\Builder\Method;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;

abstract Class AbstractEndPoint extends WebTestCase
{ 
    private array  $serverInformation=['ACCEPT'=>'application/json', 'CONTENT_TYPE'=>'application/json'];
    public function GetResponseFromRequest(string $method,string $uri,string $payload=''):Response
    {
     
       
         $client= self::createClient();
         $client->request(
             $method,
             $uri . 'json',
             [],
             [], 
             $this->serverInformation,
            $payload
             
            
            
            
            
            );
         return $client->getResponse();
    }
   

}