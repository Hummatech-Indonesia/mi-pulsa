<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasOneLicense
{
    /**
     * One-to-Many relationship with License Model
     *
     * @return BelongsTo
     */

    public function license(): BelongsTo;
}
