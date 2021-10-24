<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

#[Autoconfigure(tags: ['whatwedo_core.formatter'])]
interface FormatterInterface
{
    public function getString($value): string;

    public function getHtml($value): string;

    public function processOptions(?array $options);
}
