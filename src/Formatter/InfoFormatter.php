<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoFormatter extends TwigFormatter
{
    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('template', '@whatwedoCore/formatter/info.html.twig');
    }
}
