<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

/**
 * Default formatter.
 */
class DefaultFormatter extends AbstractFormatter
{
    public function getString($value): string
    {
        return (string)$value;
    }
}
