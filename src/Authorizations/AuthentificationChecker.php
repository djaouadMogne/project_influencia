<?php

declare(strict_types=1);

namespace App\Authorizations;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\User;
use App\Exception\ResourceAccesException;
use Symfony\Component\HttpFoundation\Response;

class AuthentificationChecker implements AuthentificationCheckerInterface
{
    private Security $security;
    private  User $user;
    public function __construct(Security $security)
    {
        $this->user=$security->getUser();
    }

    public function isAuthenticated(): void
    {
        if(null===$this->users)
        {
            throw new ResourceAccesException(Response::HTTP_UNAUTHORIZED,self::MESSAGE_ERROR);
        }
    }

}