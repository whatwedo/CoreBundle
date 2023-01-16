<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeFormatter extends AbstractFormatter
{
    public const OPT_FORMAT = 'format';

    public function getString(mixed $value): string
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format($this->options[self::OPT_FORMAT]);
        }

        return '';
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault(self::OPT_FORMAT, 'd.m.Y H:i');
    }
}
