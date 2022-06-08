<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\Nl2brFormatter;

class Nl2brFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(Nl2brFormatter::class);
        $formatter->processOptions();
        self::assertSame('1<br />
        23<br />
        3', $formatter->getHtml('1
        23
        3'));
    }
}
