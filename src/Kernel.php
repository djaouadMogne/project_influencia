<?php

namespace App;

use App\DependencyInjection\Compiler\ExceptionNormalizerPassInterface;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use App\DependencyInjection\Compiler\ExceptionNormalizerPass;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    protected function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ExceptionNormalizerPass());
    }
}
