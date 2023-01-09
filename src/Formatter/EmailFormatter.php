<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Contracts\Translation\TranslatorInterface;

class EmailFormatter extends AbstractFormatter
{

    public function __construct(private TranslatorInterface $translator)
    {
        parent::__construct();
    }

    public function getString(mixed $value): string
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? $value : '';
    }

    public function getHtml(mixed $value): string
    {
        $value = $this->getString($value);

        $title = $this->translator->trans('whatwedo_core.send_email');
        return $value ? sprintf(
            '<a href="mailto:%s" title="%s">%s</a>',
            $title,
            $value,
            $value
        ) : '';
    }
}
