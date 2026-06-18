<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectionFormatter extends AbstractFormatter
{
    public function getString(mixed $value): string
    {
        if (! is_iterable($value)) {
            return '';
        }
        if ($value instanceof Collection) {
            $value = $value->toArray();
        }
        return implode(', ', (array) $value);
    }

    public function getHtml(mixed $value): string
    {
        if (! is_iterable($value)) {
            return '';
        }
        if ($value instanceof Collection) {
            $value = $value->toArray();
        }
        $str = '<ul>';
        foreach ($value as $singleValue) {
            $str .= '<li>'.$this->escapeHTML($singleValue).'</li>';
        }

        return $str.'</ul>';
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefault(self::OPT_HTML_SAFE, true);
    }
}
