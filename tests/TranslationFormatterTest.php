<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\TranslationFormatter;

class TranslationFormatterTest extends AbstractFormatterTest
{
    public function testFormatter(): void
    {
        $formatter = $this->getFormatter(TranslationFormatter::class);
        $formatter->processOptions([]);
        self::assertSame('Der Test', $formatter->getHtml('label.test'));
    }

    public function testFormatterLocale(): void
    {
        $formatter = $this->getFormatter(TranslationFormatter::class);
        $formatter->processOptions([
            TranslationFormatter::OPT_LOCALE => 'en',
        ]);
        self::assertSame('The Test', $formatter->getHtml('label.test'));
    }

    public function testFormatterDomain(): void
    {
        $formatter = $this->getFormatter(TranslationFormatter::class);
        $formatter->processOptions([
            TranslationFormatter::OPT_LOCALE => 'de',
            TranslationFormatter::OPT_DOMAIN => 'domain',
            TranslationFormatter::OPT_PARAMETERS => [
                '%param%' => 'beste',
            ],
        ]);
        self::assertSame('Der beste Test', $formatter->getHtml('label.test'));
    }
}
