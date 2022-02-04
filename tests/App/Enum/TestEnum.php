<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Tests\App\Enum;

enum TestEnum: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
