<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasTransaction
{
    /**
     * One-to-Many relationship with Transaction Model
     *
     * @return BelongsTo
     */

    public function transaction(): BelongsTo;
}
