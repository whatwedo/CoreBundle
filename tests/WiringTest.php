<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use whatwedo\CoreBundle\Manager\FormatterManager;

class WiringTest extends KernelTestCase
{
    public function testServiceWiring(): void
    {
        foreach ([
            FormatterManager::class,
        ] as $serviceClass) {
            self::assertInstanceOf(
                $serviceClass,
                self::getContainer()->get($serviceClass)
            );
        }
    }
}
