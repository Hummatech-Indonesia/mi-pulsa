<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasRatings
{
    /**
     * One-to-Many relationship with Product Testimonials Model
     *
     * @return HasMany
     */

    public function product_ratings(): HasMany;
}
