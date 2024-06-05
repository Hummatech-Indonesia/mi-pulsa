<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasOneRefund
{
    /**
     * One-to-One relationship with Detail Transaction Model
     *
     * @return HasOne
     */

    public function refund(): HasOne;
}
