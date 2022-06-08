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
        self::assertSame('Schweiz', $formatter->getHtml('CH'));
    }

    public function testFormatterEnglish()
    {
        $formatter = $this->getFormatter(CountryAlpha2Formatter::class);
        $formatter->processOptions([
            'locale' => 'US',
        ]);
        self::assertSame('Switzerland', $formatter->getHtml('CH'));
    }
}
