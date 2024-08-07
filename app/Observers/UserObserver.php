<?php

namespace App\Observers;

use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\User;
use Faker\Provider\Uuid;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param User $user
     * @return void
     */
    public function creating(User $user): void
    {
        $user->id = Uuid::uuid();
        
    }
}
