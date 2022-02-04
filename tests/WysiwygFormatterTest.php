<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\WysiwygFormatter;

class WysiwygFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(WysiwygFormatter::class);
        $formatter->processOptions();
        $this->assertSame('<blockquote>hallo Welt</blockquote>', $formatter->getHtml('hallo Welt'));
    }
}
