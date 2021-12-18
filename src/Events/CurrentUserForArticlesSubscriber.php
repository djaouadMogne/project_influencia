<?php

declare(strict_types=1);
namespace App\Events;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Article;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

class CurrentUserForArticlesSubscriber implements EventSubscriberInterface
{
    private Security $securty;
    public function _construct(Security $security)
    {
        $this->security=$security;
    
    }

    public static function getSubscribedEvents()
    {
        return[
           KernelEvents::VIEW=>['currentUserForArticles', EventPriorities::PRE_VALIDATE]
        ];
    }
    public function currentUserForArticles(ViewEvent $event):void
    {
        $article=$event->getControllerResult();
        $method=$event->getRequest()->getMethod();

        if($article instanceof Article && Request::METHOD_POST ===$method)
        {
            $article->setAuthor($this->security->getUser());
        }
    }
}