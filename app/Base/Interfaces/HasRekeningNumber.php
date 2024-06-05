<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasRekeningNumber
{

    /**
     * One-to-Many relationship with User Model
     *
     * @return BelongsTo
     */

    public function rekening_number(): BelongsTo;
}
