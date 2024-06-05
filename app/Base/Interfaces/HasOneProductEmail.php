<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasOneProductEmail
{

    /**
     * One-to-Many relationship with Product Questions Model
     *
     * @return HasOne
     */

    public function productEmail(): HasOne;
}
