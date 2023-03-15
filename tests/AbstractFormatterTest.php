<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use whatwedo\CoreBundle\Formatter\FormatterInterface;
use whatwedo\CoreBundle\Manager\FormatterManager;

abstract class AbstractFormatterTest extends KernelTestCase
{
    protected function getFormatter(string $formatterClass): FormatterInterface
    {
        $formatterManager = self::getContainer()->get(FormatterManager::class);

        return $formatterManager->getFormatter($formatterClass);
    }
}
