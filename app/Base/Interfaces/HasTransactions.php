<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasTransactions
{
    /**
     * One-to-Many relationship with Transaction Model
     *
     * @return HasMany
     */

    public function transactions(): HasMany;
}
