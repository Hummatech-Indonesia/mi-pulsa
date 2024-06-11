<?php

namespace App\Observers\Dashboard;

use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\Customer;
use App\Models\TopupAgen;
use App\Models\User;
use Faker\Provider\Uuid;

class Topupagenobserver
{
    /**
     * Method creating
     *
     * @param TopupAgen $TopupAgen [explicite description]
     *
     * @return void
     */
    public function creating(TopupAgen $TopupAgen): void
    {
        $TopupAgen->id = Uuid::uuid();
    }
}
