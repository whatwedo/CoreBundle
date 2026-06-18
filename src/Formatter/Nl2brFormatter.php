<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

class Nl2brFormatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        return $value;
    }

    public function getHtml(mixed $value): string
    {
        return nl2br($this->escapeHTML($value));
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefault(self::OPT_HTML_SAFE, true);
    }
}
