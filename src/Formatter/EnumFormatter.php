<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnumFormatter extends AbstractFormatter
{
    public function __construct(
        private TranslatorInterface $translator
    ) {
    }

    public function getString($enum): string
    {
        if (! $enum) {
            return '';
        }

        return $this->translator->trans($this->options['translation_key_prefix'] . $enum->value);
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_key_prefix', '');
    }
}
