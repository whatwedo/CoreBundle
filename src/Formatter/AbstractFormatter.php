<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractFormatter implements FormatterInterface
{
    public const OPT_HTML_SAFE = 'html_safe';

    /**
     * @var array<string, mixed>
     */
    protected array $options = [];

    public function __construct()
    {
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

    public function isHtmlSafe(): bool
    {
        return (bool) ($this->options[self::OPT_HTML_SAFE] ?? false);
    }

    protected function escapeHTML(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault(self::OPT_HTML_SAFE, false);
    }
}
