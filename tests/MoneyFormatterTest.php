<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\MoneyFormatter;

class MoneyFormatterTest extends AbstractFormatterTest
{
    public function testFormatter(): void
    {
        $formatter = $this->getFormatter(MoneyFormatter::class);
        $formatter->processOptions();
        self::assertSame('CHF 12.33', $formatter->getHtml(12.33445));
    }
}
