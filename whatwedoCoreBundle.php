<?php

namespace whatwedo\CoreBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use whatwedo\CoreBundle\DependencyInjection\Compiler\FormatterPass;

/**
 * Class whatwedoCoreBundle
 * @package whatwedo\CoreBundle
 */
class whatwedoCoreBundle extends Bundle
{

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FormatterPass());
    }
}
