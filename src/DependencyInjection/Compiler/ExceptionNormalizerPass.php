<?php

declare(strict_types=1);

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class ExceptionNormalizerPass implements CompilerPAssInterface
{
    public function process(ContainerBuilder $container)
    {
        $exceptionListenerDefinition= $container->findDefinition('influencia.exception_subscriber');
        $normalizers= $container->findTaggedServiceIds('influencia.normalizer');

        foreach($normalizers as $normalizer=> $tags)
        {
            $exceptionListenerDefinition->addMethodCall('addNormalizer', [new Reference($normalizer)]);
        }


    }
}