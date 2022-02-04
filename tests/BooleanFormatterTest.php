<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\BooleanFormatter;

class BooleanFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(BooleanFormatter::class);
        $this->assertSame('Ja', $formatter->getHtml(true));
        $this->assertSame('Nein', $formatter->getHtml(false));
    }
}
