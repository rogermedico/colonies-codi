<?php

namespace Database\Factories;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'folder_id' => Folder::factory(),
            'code' => fake()->regexify('[A-Z0-9]{6}'),
            'order' => fake()->unique()->randomNumber(),
            'solved' => false,
        ];
    }
}
