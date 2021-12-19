<?php

declare(strict_types=1);

namespace App\Authorizations;






interface AuthentificationCheckerInterface
{
    const MESSAGE_ERROR= 'is not your resource';
    public function isAuthenticated():void;
}