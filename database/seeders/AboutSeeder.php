<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'title' => 'Tentang MiPulsa',
            'description' => 'MiPulsa adalah platform terpercaya untuk top up pulsa dengan harga terbaik dan pelayanan cepat.',
            'image' => 'https://themewagon.github.io/startup2/img/about.jpg',
            'phone_number' => "+6285176777785",
            // Tambahkan data lainnya jika diperlukan
        ]);
    }
}
