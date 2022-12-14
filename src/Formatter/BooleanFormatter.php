<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

class BooleanFormatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        return $value ? 'Ja' : 'Nein';
    }
}
