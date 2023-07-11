<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    private const NUMBER_OF_CODES = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Folder::all()
            ->each(function (Folder $folder) {
                for ($i = 0; $i < self::NUMBER_OF_CODES; $i++) {
                    Code::factory()
                        ->create([
                            'folder_id' => $folder->id,
                            'order' => $i,
                        ]);
                }
            });
    }
}
