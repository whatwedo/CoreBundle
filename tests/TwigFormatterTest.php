<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests;

use whatwedo\CoreBundle\Formatter\TwigFormatter;

class TwigFormatterTest extends AbstractFormatterTest
{
    public function testFormatter()
    {
        $this->markTestSkipped('to do');
        $formatter = $this->getFormatter(TwigFormatter::class);
        $formatter->processOptions([
            'template' => 'test.html.twig',
        ]);
        $this->assertSame('<blockquote>hallo Welt</blockquote>', $formatter->getHtml('hallo Welt'));
    }
}
