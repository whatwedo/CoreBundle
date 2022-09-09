<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryAlpha2Formatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        if (Countries::exists(mb_strtoupper($value))) {
            return Countries::getName(mb_strtoupper($value), $this->options['locale']);
        }

        return $value;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('locale', 'de');
    }
}
