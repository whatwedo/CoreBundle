<?php

namespace whatwedo\CoreBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use whatwedo\CoreBundle\DependencyInjection\Compiler\FormatterPass;

/**
 * Class whatwedoCoreBundle.
 */
class whatwedoCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FormatterPass());
    }
}
