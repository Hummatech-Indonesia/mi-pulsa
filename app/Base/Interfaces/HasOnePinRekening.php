<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasOnePinRekening
{
    /**
     * One-to-Many relationship with License Model
     *
     * @return HasOne
     */

    public function pinRekening(): HasOne;
}
