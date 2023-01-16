<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoneyFormatter extends AbstractFormatter
{
    public const OPT_CURRENCY = 'currency';

    public const OPT_CURRENCY_POSITION = 'currency_position';

    public const OPT_DECIMALS = 'decimals';

    public const OPT_DECIMAL_SEPARATOR = 'decimal_separator';

    public const OPT_DIVISOR = 'divisor';

    public const OPT_THOUSANDS_SEPARATOR = 'thousands_separator';

    public const OPT_ROUND_FIVE_CENTIMES = 'round_five_centimes';

    public function getString(mixed $value): string
    {
        if ($value === null) {
            return '';
        }
        $value /= $this->options[self::OPT_DIVISOR];
        if ($this->options[self::OPT_ROUND_FIVE_CENTIMES]) {
            $value = bcdiv((string) bcmul((string) $value, '20', 2), '20', 2);
        }

        $str = number_format(
            (float) $value,
            $this->options[self::OPT_DECIMALS],
            $this->options[self::OPT_DECIMAL_SEPARATOR],
            $this->options[self::OPT_THOUSANDS_SEPARATOR]
        );

        if ($this->options[self::OPT_CURRENCY_POSITION] === 'start') {
            return $this->options[self::OPT_CURRENCY] . ' ' . $str;
        }

        return $str . ' ' . $this->options[self::OPT_CURRENCY];
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            self::OPT_CURRENCY => 'CHF',
            self::OPT_CURRENCY_POSITION => 'start',
            self::OPT_DECIMALS => 2,
            self::OPT_DECIMAL_SEPARATOR => '.',
            self::OPT_DIVISOR => 1,
            self::OPT_THOUSANDS_SEPARATOR => "'",
        ]);
        $resolver->setAllowedValues(self::OPT_CURRENCY_POSITION, ['start', 'end']);
        $resolver->setDefault(self::OPT_ROUND_FIVE_CENTIMES, fn (Options $options) => $options['currency'] === 'CHF');
    }
}
