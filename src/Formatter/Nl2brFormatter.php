<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

class Nl2brFormatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        return (string) $value;
    }

    public function getHtml(mixed $value): string
    {
        return nl2br((string) $value);
    }
}
