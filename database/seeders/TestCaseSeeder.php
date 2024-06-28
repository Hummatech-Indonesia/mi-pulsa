<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Seeder;

class TestCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'agen@gmail.com')->first();
        $product = Product::query()->where('buyer_sku_code', 'xld10')->first();
        for ($i = 1; $i <= 480; $i++) {
            Customer::query()->create([
                'id' => Uuid::uuid(),
                'name' => 'Testing Pending Sukses ' . $i,
                'user_id' => $user->id,
                'product_id' => $product->id,
                'phone_number' => '087800001233',
            ]);
        }

        for ($i = 1; $i <= 20; $i++) {
            Customer::query()->create([
                'id' => Uuid::uuid(),
                'name' => 'Testing Pending Gagal ' . $i,
                'user_id' => $user->id,
                'product_id' => $product->id,
                'phone_number' => '087800001234',
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Customer::query()->create([
                'id' => Uuid::uuid(),
                'name' => 'Testing Gagal ' . $i,
                'user_id' => $user->id,
                'product_id' => $product->id,
                'phone_number' => '087800001232',
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Customer::query()->create([
                'id' => Uuid::uuid(),
                'name' => 'Testing Sukses ' . $i,
                'user_id' => $user->id,
                'product_id' => $product->id,
                'phone_number' => '087800001230',
            ]);
        }
    }
}
