<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfCodes = count(Folder::NAMES) - 1;

        Folder::all()
            ->each(function (Folder $folder) use ($numberOfCodes){
                for ($i = 0; $i < $numberOfCodes; $i++) {
                    Code::factory()
                        ->create([
                            'folder_id' => $folder->id,
                            'order' => $i,
                        ]);
                }
            });
    }
}
