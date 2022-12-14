<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeFormatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format($this->options['format']);
        }

        return '';
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('format', 'd.m.Y H:i');
    }
}
