<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\PercentageFormatter;

class PercentageFormatterTest extends AbstractFormatterTest
{
    public function testFormatter(): void
    {
        $formatter = $this->getFormatter(PercentageFormatter::class);
        $formatter->processOptions();
        self::assertSame('25.00%', $formatter->getHtml(0.25));
    }
}
