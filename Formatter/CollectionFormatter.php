<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

class CollectionFormatter extends AbstractFormatter
{
    public function getString($value): string
    {
        if (! is_iterable($value)) {
            return '';
        }

        return implode(', ', (array) $value);
    }

    public function getHtml($value): string
    {
        if (! is_iterable($value)) {
            return '';
        }

        $str = '<ul>';
        foreach ($value as $singleValue) {
            $str .= '<li>'.$singleValue.'</li>';
        }

        return $str.'</ul>';
    }
}
