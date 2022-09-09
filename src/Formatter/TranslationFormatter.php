<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class TranslationFormatter extends AbstractFormatter
{
    public const OPTION_LOCALE = 'locale';

    public const OPTION_DOMAIN = 'domain';

    public const OPTION_PARAMETERS = 'parameters';

    public function __construct(
        protected TranslatorInterface $translator
    ) {
    }

    public function getString(mixed $value): string
    {
        return $this->translator->trans(
            (string) $value,
            $this->options[self::OPTION_PARAMETERS],
            $this->options[self::OPTION_DOMAIN],
            $this->options[self::OPTION_LOCALE]
        );
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefault(self::OPTION_LOCALE, null);
        $resolver->setAllowedTypes(self::OPTION_LOCALE, ['null', 'string']);
        $resolver->setDefault(self::OPTION_PARAMETERS, []);
        $resolver->setAllowedTypes(self::OPTION_PARAMETERS, 'array');
        $resolver->setDefault(self::OPTION_DOMAIN, null);
        $resolver->setAllowedTypes(self::OPTION_DOMAIN, ['null', 'string']);
    }
}
