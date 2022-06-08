<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\DefaultFormatter;

class DefaultFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(DefaultFormatter::class);
        self::assertSame('test', $formatter->getHtml('test'));
    }
}
