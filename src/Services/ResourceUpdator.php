<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\User;
use App\Authorizations\ResourceAccessCheckerInterface;
use App\Authorizations\AuthentificationCheckerInterface;
use App\Exception\ResourceAccesException;
use Symfony\Component\HttpFoundation\Response;

class ResourceUpdator implements ResourceUpdatorInterface
{
    protected array $methodAllowed=[
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];

    public function __construct(ResourceAccessCheckerInterface $resourceAccessChecker,AuthentificationCheckerInterface $authentificationChecker)
    {
        $this->resourceAccessChecker = $resourceAccessChecker;
        $this->authentificationChecker= $authentificationChecker;

    }

    public function process (string $method,User $user):bool
    {
        if (in_array($method,$this->methodAllowed,true)){
            $this->authentificationChecker->isAuthenticated();
            $this->resourceAccessChecker->canAccess($user->getId());
            
            return true;
        }
        return false;
    }

}