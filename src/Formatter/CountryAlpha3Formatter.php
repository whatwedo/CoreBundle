<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryAlpha3Formatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        if (Countries::alpha3CodeExists(mb_strtoupper($value))) {
            return Countries::getAlpha3Name(mb_strtoupper($value), $this->options['locale']);
        }

        return $value;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('locale', 'de');
    }
}
