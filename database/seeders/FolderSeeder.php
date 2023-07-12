<?php

namespace Database\Seeders;

use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    private const FOLDER_NAMES = [
        'Carpeta vermella',
        'Carpeta verda',
        'Carpeta blava',
        'Carpeta groga',
        'Carpeta marró',
        'Carpeta blanca',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folderNames = self::FOLDER_NAMES;

        shuffle($folderNames);

        foreach ($folderNames as $folderName) {
            Folder::factory()->create([
                'name' => $folderName,
            ]);
        }
    }
}
