<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\User;

interface ResourceUpdatorInterface
{
    public function process(string $method,User $user):bool;
}