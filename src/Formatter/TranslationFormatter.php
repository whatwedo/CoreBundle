<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class TranslationFormatter extends AbstractFormatter
{
    public const OPT_LOCALE = 'locale';

    public const OPT_DOMAIN = 'domain';

    public const OPT_PARAMETERS = 'parameters';

    public function __construct(
        protected TranslatorInterface $translator
    ) {
    }

    public function getString(mixed $value): string
    {
        return $this->translator->trans(
            (string) $value,
            $this->options[self::OPT_PARAMETERS],
            $this->options[self::OPT_DOMAIN],
            $this->options[self::OPT_LOCALE]
        );
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefault(self::OPT_LOCALE, null);
        $resolver->setAllowedTypes(self::OPT_LOCALE, ['null', 'string']);
        $resolver->setDefault(self::OPT_PARAMETERS, []);
        $resolver->setAllowedTypes(self::OPT_PARAMETERS, 'array');
        $resolver->setDefault(self::OPT_DOMAIN, null);
        $resolver->setAllowedTypes(self::OPT_DOMAIN, ['null', 'string']);
    }
}
