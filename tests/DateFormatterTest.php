<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\DateFormatter;

class DateFormatterTest extends AbstractFormatterTest
{
    public function testFormatter(): void
    {
        $formatter = $this->getFormatter(DateFormatter::class);
        self::assertSame('04.02.2022', $formatter->getHtml(new \DateTime('2022-02-04 13:45:56')));
    }
}
