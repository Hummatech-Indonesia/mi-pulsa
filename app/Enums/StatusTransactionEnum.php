<?php

namespace App\Enums;

enum StatusTransactionEnum: string
{
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case EXPIRED = 'expired';
    case FAILED = 'failed';
    case REFUND = 'refund';
}
