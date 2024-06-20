<?php

namespace App\Observers\Dashboard;

use App\Models\TopupAgen;
use Faker\Provider\Uuid;

class TopupAgenObserver
{
    /**
     * Method creating
     *
     * @param TopupAgen $TopupAgen [explicite description]
     *
     * @return void
     */
    public function creating(TopupAgen $topupAgen): void
    {
        $topupAgen->id = Uuid::uuid();
    }
}
