<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractFormatter implements FormatterInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $options = [];

    public function __construct()
    {
        $this->processOptions();
    }

    public function getHtml(mixed $value): string
    {
        return $this->getString($value);
    }

    /**
     * @param array<string, mixed> $options
     */
    public function processOptions(array $options = []): void
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
    }
}
