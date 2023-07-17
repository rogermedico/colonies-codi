<?php

namespace Database\Seeders;

use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folderNames = Folder::NAMES;

        shuffle($folderNames);

        foreach ($folderNames as $folderName) {
            Folder::factory()->create([
                'name' => $folderName,
            ]);
        }
    }
}
