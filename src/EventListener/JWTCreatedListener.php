<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\Security\Core\Security;

class JWTCreatedListener
{
    private User $user;

    public function __construct(Security $security)
    {
        $this->user= $security->getUser();
    }


    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $payload        = $event->getData();
        $payload['createdAt']=$this->user->getCreatedAt();
     
    }
}