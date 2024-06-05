<?php

namespace App\Observers\Dashboard;

use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Faker\Provider\Uuid;

class ProductObserver
{
    public function creating(Product $product): void
    {
        $product->id = Uuid::uuid();
    }
}
