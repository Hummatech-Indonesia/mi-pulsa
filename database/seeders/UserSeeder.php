<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Outlet;
use App\Models\Store;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Assuming you have roles created already
        $roles = Role::all();

        foreach ($roles as $role) {
            User::create([
                'id' => Uuid::uuid(),
                'name' => $role->name,
                'email' => str_replace(' ', '', $role->name) . "@gmail.com",
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
