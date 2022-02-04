<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\CountryAlpha3Formatter;

class CountryAlpha3FormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(CountryAlpha3Formatter::class);
        $this->assertSame('Schweiz', $formatter->getHtml('CHE'));
    }

    public function testFormatterEnglish()
    {
        $formatter = $this->getFormatter(CountryAlpha3Formatter::class);
        $formatter->processOptions([
            'locale' => 'US',
        ]);
        $this->assertSame('Switzerland', $formatter->getHtml('CHE'));
    }
}
