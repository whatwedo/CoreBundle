<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\CountryAlpha3Formatter;

class CountryAlpha3FormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(CountryAlpha3Formatter::class);
        self::assertSame('Schweiz', $formatter->getHtml('CHE'));
    }

    public function testFormatterEnglish()
    {
        $formatter = $this->getFormatter(CountryAlpha3Formatter::class);
        $formatter->processOptions([
            'locale' => 'US',
        ]);
        self::assertSame('Switzerland', $formatter->getHtml('CHE'));
    }
}
