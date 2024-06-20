<?php

namespace App\Observers;

use App\Models\TopupAgen;
use Faker\Provider\Uuid;

class TopupAgenObserver
{
    /**
     * Handle the TopupAgen "created" event.
     */
    public function creating(TopupAgen $topupAgen): void
    {
        $topupAgen->id = Uuid::uuid();
    }
}
