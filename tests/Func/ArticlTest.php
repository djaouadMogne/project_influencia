<?php

declare(strict_types=1);

namespace App\tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use App\tests\Func\AbstractEndPoint;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

Class ArticlTest extends AbstractEndPoint
{
    public function testArticles():void
    {
        $response=$this->GetResponseFromRequest(
            Request::METHOD_GET,
            '/api/articles',
            '',
            [],
            false
        );

        $responseContent=$response->getContent();
        $responseDecoded=json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
        self::assertNotEmpty($responseDecoded);
        self::assertJson($responseContent);
    }
}