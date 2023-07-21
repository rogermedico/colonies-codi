<?php

namespace Database\Seeders;

use App\Models\Countdown;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Countdown::factory()->create();
    }
}
