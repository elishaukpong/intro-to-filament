<?php

declare(strict_types=1);

namespace App\Enum;

enum Status: string
{
    case draft = 'Draft';
    case published = 'Published';
    case archived = 'Archived';
}
