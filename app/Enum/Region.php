<?php

declare(strict_types=1);

namespace App\Enum;

enum Region: string
{
    case US = 'US';
    case EU = 'EU';
    case AU = 'AU';
    case INDIA = 'India';
    case NIGERIA = 'Nigeria';
    case ONLINE = 'Online';

}