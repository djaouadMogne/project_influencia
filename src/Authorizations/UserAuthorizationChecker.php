<?php

declare(strict_types=1);

namespace App\Authorizations;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\User;


class UserAuthorizationChecker
{
    private array $methodAllowed= [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];

    private ?User $user;

    public function _construct(Security $security)
    {
        $this->user=$security->getUser();
    }

    public function check(User $user, string $method): void
    {
        $this->isAuthenticated();

        if($this->isMethodAllowed($method) && $user->getId() !==$this->user->getId())
        {
            $errorMessage="it's not your resource";
            throw new UnauthorizedHttpException($errorMessage,$errorMessage);
        }
    } 

    public function isAuthenticated()
    {
        if(null === $this->user)
        {
            $error ="You ara not authenticated";
            throw new UnauthorizedHttpException($error, $error);

        }
    }

    public function isMethodAllowed(string $method):bool
    {
        return in_array($method, $this->methodAllowed, true);
    }

}
