<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\Intl\Countries;

class CountryAlpha3Formatter extends AbstractFormatter
{
    public function getString($value): string
    {
        if (Countries::alpha3CodeExists(mb_strtoupper($value))) {
            return Countries::getAlpha3Name(mb_strtoupper($value));
        }

        return $value;
    }
}
