<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @TODO check MoneyType
 */
class MoneyFormatter extends AbstractFormatter
{
    public function getString($value): string
    {
        $value /= $this->options['divisor'];
        if ($this->options['round_five_centimes']) {
            $value = bcdiv((string)bcmul((string)$value, '20', 2), '20', 2);
        }

        $str = number_format(
            (float)$value,
            $this->options['decimals'],
            $this->options['decimal_separator'],
            $this->options['thousands_separator']
        );

        if ('start' === $this->options['currency_position']) {
            return $this->options['currency'].' '.$str;
        }

        return $str.' '.$this->options['currency'];
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'currency' => 'CHF',
            'currency_position' => 'start',
            'decimals' => 2,
            'decimal_separator' => '.',
            'divisor' => 1,
            'thousands_separator' => "'",
        ]);
        $resolver->setAllowedValues('currency_position', ['start', 'end']);
        $resolver->setDefault('round_five_centimes', fn (Options $options) => 'CHF' === $options['currency']);
    }
}
