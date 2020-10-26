<?php

namespace whatwedo\CoreBundle\Formatter;

use Twig\Markup;
use Twig\TwigFilter;

trait TwigFilterTrait
{
    protected function getFilterName(): string
    {
        $arr = explode('\\', self::class);
        $filterName = array_pop($arr);

        return $this->camel_to_snake($filterName);
    }

    public function getFilters()
    {
        return [
            new TwigFilter($this->getFilterName(), [ $this, 'applyFilter']),
        ];
    }

    public function applyFilter($value, array $options = []) {
        $this->processOptions($options);
        return new Markup($this->getHtml($value), 'UTF-8');
    }

    private function camel_to_snake($input)
    {
        if (0 === preg_match('/[A-Z]/', $input)) {
            return $input;
        }
        $pattern = '/([a-z])([A-Z])/';
        $r = strtolower(preg_replace_callback($pattern, function ($a) {
            return $a[1].'_'.strtolower($a[2]);
        }, $input));

        return $r;
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
}
