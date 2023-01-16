<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DateFormatter extends DateTimeFormatter
{
    public const OPT_FORMAT = 'format';

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault(self::OPT_FORMAT, 'd.m.Y');
    }
}
