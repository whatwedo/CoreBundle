<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\DefaultFormatter;

class DefaultFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(DefaultFormatter::class);
        $this->assertSame('test', $formatter->getHtml('test'));
    }
}
