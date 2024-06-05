<?php

namespace App\Observers\Dashboard;

use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\Customer;
use App\Models\User;
use Faker\Provider\Uuid;

class CustomerObserver
{
    /**
     * Method creating
     *
     * @param Customer $customer [explicite description]
     *
     * @return void
     */
    public function creating(Customer $customer): void
    {
        $customer->id = Uuid::uuid();
        $customer->user_id = auth()->user()->id;
    }
}
