<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\DateTimeFormatter;

class DateTimeFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(DateTimeFormatter::class);
        $this->assertSame('04.02.2022 13:45', $formatter->getHtml(new \DateTime('2022-02-04 13:45:56')));
    }
}
