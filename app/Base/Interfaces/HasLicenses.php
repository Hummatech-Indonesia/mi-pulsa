<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasLicenses
{
    /**
     * One-to-Many relationship with License Model
     *
     * @return HasMany
     */

    public function licenses(): HasMany;
}
