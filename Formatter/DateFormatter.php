<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DateFormatter extends DateTimeFormatter
{
    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('format', 'd.m.Y');
    }
}
