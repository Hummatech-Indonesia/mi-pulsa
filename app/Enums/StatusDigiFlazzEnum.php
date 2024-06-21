<?php

namespace App\Enums;

enum StatusDigiFlazzEnum: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
