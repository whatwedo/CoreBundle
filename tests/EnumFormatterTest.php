<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\EnumFormatter;
use whatwedo\CoreBundle\Tests\App\Enum\TestEnum;

class EnumFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(EnumFormatter::class);
        $this->assertSame('archived', $formatter->getHtml(TestEnum::ARCHIVED));
    }
}
