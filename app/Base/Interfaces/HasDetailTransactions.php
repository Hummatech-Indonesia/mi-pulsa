<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasDetailTransactions
{
    /**
     * One-to-Many relationship with License Model
     *
     * @return HasMany
     */

    public function detailTransactions(): HasMany;
}
