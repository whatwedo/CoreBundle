<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\CollectionFormatter;

class CollectionFormatterTest extends AbstractFormatterTest
{
    public function testFormatter(): void
    {
        $formatter = $this->getFormatter(CollectionFormatter::class);
        self::assertSame('<ul><li>eins</li><li>zwei</li></ul>', $formatter->getHtml(['eins', 'zwei']));
    }
}
