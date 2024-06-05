<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasProductFavorites
{

    /**
     * One-to-Many relationship with Product Questions Model
     *
     * @return HasMany
     */

    public function product_favorites(): HasMany;
}
