<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Formatter;

use Symfony\Contracts\Translation\TranslatorInterface;

class BooleanFormatter extends AbstractFormatter
{

    public function __construct(private TranslatorInterface $translator)
    {
        parent::__construct();
    }

    public function getString(mixed $value): string
    {
        $msg = $value ? 'whatwedo_core.yes' : 'whatwedo_core.no';
        return $this->translator->trans($msg);
    }
}
