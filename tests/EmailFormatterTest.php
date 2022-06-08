<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\EmailFormatter;

class EmailFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(EmailFormatter::class);
        self::assertSame('<a href="mailto:test@whatwedo.ch" title="E-Mail senden">test@whatwedo.ch</a>', $formatter->getHtml('test@whatwedo.ch'));
    }
}
