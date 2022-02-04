<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

class EmailFormatter extends AbstractFormatter
{
    public function getString($value): string
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? $value : '';
    }

    public function getHtml($value): string
    {
        $value = $this->getString($value);

        return $value ? sprintf(
            '<a href="mailto:%s" title="E-Mail senden">%s</a>',
            $value,
            $value
        ) : '';
    }
}
