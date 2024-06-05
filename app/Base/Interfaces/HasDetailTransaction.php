<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasDetailTransaction
{
    /**
     * One-to-One relationship with Detail Transaction Model
     *
     * @return HasOne
     */

    public function detail_transaction(): HasOne;
}
