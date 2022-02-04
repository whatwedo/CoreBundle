<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\CollectionFormatter;

class CollectionFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $formatter = $this->getFormatter(CollectionFormatter::class);
        $this->assertSame('<ul><li>eins</li><li>zwei</li></ul>', $formatter->getHtml(['eins', 'zwei']));
    }
}
