<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\CountryAlpha2Formatter;

class CountryAlpha2FormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(CountryAlpha2Formatter::class);
        $formatter->processOptions();
        $this->assertSame('Schweiz', $formatter->getHtml('CH'));
    }

    public function testFormatterEnglish()
    {
        $formatter = $this->getFormatter(CountryAlpha2Formatter::class);
        $formatter->processOptions([
            'locale' => 'US',
        ]);
        $this->assertSame('Switzerland', $formatter->getHtml('CH'));
    }
}
