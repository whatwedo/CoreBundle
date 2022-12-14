<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\EnumFormatter;
use whatwedo\CoreBundle\Tests\App\Enum\TestEnum;

class EnumFormatterTest extends AbstractFormatterTest
{
    public function testFormatter(): void
    {
        $formatter = $this->getFormatter(EnumFormatter::class);
        $formatter->processOptions();
        self::assertSame('archived', $formatter->getHtml(TestEnum::ARCHIVED));
    }
}
