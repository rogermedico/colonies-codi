<?php

namespace Database\Factories;

use App\Models\Folder;
use Database\Seeders\FolderSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CountdownFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'finish' => now('Europe/Madrid')->addHours(3),
        ];
    }
}
