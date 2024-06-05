<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasOneProduct
{
    /**
     * One-to-Many relationship with Product Model
     *
     * @return BelongsTo
     */

    public function product(): BelongsTo;
}
