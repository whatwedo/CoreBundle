<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\Intl\Countries;

class CountryAlpha2Formatter extends AbstractFormatter
{
    public function getString($value): string
    {
        if (Countries::exists(mb_strtoupper($value))) {
            return Countries::getName(mb_strtoupper($value));
        }

        return $value;
    }
}
