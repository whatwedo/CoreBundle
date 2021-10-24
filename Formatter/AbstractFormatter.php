<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractFormatter implements FormatterInterface
{
    protected array $options = [];

    public function getHtml($value): string
    {
        return $this->getString($value);
    }

    public function processOptions(?array $options): void
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
    }
}
