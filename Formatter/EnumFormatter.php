<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnumFormatter extends AbstractFormatter
{
    public function __construct(
        private TranslatorInterface $translator
    )
    {}

    public function getString($enum): string
    {
        return $this->translator->trans($enum->value);
    }
}
