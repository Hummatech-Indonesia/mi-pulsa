<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasCustomer
{

    /**
     * One-to-Many relationship with User Model
     *
     * @return BelongsTo
     */

    public function customer(): BelongsTo;
}
