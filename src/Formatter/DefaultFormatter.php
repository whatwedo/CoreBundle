<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

class DefaultFormatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        return (string) $value;
    }
}
