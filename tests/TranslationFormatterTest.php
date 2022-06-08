<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\TranslationFormatter;

class TranslationFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(TranslationFormatter::class);
        $formatter->processOptions([]);
        self::assertSame('The Test', $formatter->getHtml('label.test'));
    }

    public function testFormatterLocale()
    {
        $formatter = $this->getFormatter(TranslationFormatter::class);
        $formatter->processOptions([
            TranslationFormatter::OPTION_LOCALE => 'de',
        ]);
        self::assertSame('Der Test', $formatter->getHtml('label.test'));
    }

    public function testFormatterDomain()
    {
        $formatter = $this->getFormatter(TranslationFormatter::class);
        $formatter->processOptions([
            TranslationFormatter::OPTION_LOCALE => 'de',
            TranslationFormatter::OPTION_DOMAIN => 'domain',
            TranslationFormatter::OPTION_PARAMETERS => [
                '%param%' => 'beste',
            ],
        ]);
        self::assertSame('Der beste Test', $formatter->getHtml('label.test'));
    }
}
