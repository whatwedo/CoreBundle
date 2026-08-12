<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\CollectionFormatter;

class CollectionFormatterTest extends AbstractFormatterTest
{
    public function testGetHtml(): void
    {
        $formatter = $this->getFormatter(CollectionFormatter::class);
        self::assertSame('<ul><li>one</li><li>two</li></ul>', $formatter->getHtml(['one', 'two']));
    }

    public function testGetHtmlWithObjects(): void
    {
        $object = new class() {
            public function __toString(): string
            {
                return 'entity-value';
            }
        };

        $formatter = $this->getFormatter(CollectionFormatter::class);
        self::assertSame('<ul><li>entity-value</li></ul>', $formatter->getHtml([$object]));
    }

    public function testGetString(): void
    {
        $formatter = $this->getFormatter(CollectionFormatter::class);
        self::assertSame('one, two', $formatter->getString(['one', 'two']));
    }

    public function testGetStringWithObjects(): void
    {
        $object = new class() {
            public function __toString(): string
            {
                return 'entity-value';
            }
        };

        $formatter = $this->getFormatter(CollectionFormatter::class);
        self::assertSame('entity-value', $formatter->getString([$object]));
    }
}
