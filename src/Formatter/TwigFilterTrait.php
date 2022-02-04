<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Twig\Markup;
use Twig\TwigFilter;

trait TwigFilterTrait
{
    abstract public function getHtml($data);

    abstract public function processOptions(?array $options);

    public function getFilters()
    {
        return [
            new TwigFilter($this->getFilterName(), fn ($data, array $options = []) => $this->applyFormatter($data, $options)),
        ];
    }

    public function getTokenParsers()
    {
        return [];
    }

    public function getNodeVisitors()
    {
        return [];
    }

    public function getTests()
    {
        return [];
    }

    public function getFunctions()
    {
        return [];
    }

    public function getOperators()
    {
        return [];
    }

    protected function getFilterName(): string
    {
        $arr = explode('\\', self::class);
        $filterName = array_pop($arr);

        return $this->camel_to_snake($filterName);
    }

    private function applyFormatter($data, array $options = []): \Twig\Markup
    {
        $this->processOptions($options);

        return new Markup($this->getHtml($data), 'UTF-8');
    }

    private function camel_to_snake($input)
    {
        if (preg_match('#[A-Z]#', $input) === 0) {
            return $input;
        }
        $pattern = '/([a-z])([A-Z])/';

        return strtolower(preg_replace_callback($pattern, fn ($a) => $a[1] . '_' . strtolower($a[2]), $input));
    }
}
