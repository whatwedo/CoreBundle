<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Doctrine\Common\Collections\Collection;

class CollectionFormatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        if (! is_iterable($value)) {
            return '';
        }
        if ($value instanceof Collection) {
            $value = $value->toArray();
        }
        return implode(', ', (array) $value);
    }

    public function getHtml(mixed $value): string
    {
        if (! is_iterable($value)) {
            return '';
        }
        if ($value instanceof Collection) {
            $value = $value->toArray();
        }
        $str = '<ul>';
        foreach ($value as $singleValue) {
            $str .= '<li>' . $singleValue . '</li>';
        }

        return $str . '</ul>';
    }
}
