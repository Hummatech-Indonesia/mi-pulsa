<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasTransactionAffiliates
{
    /**
     * One-to-Many relationship with License Model
     *
     * @return HasMany
     */

    public function transaction_affiliates(): HasMany;
}
