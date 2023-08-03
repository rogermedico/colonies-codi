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
        //$this->randomCodes();
        $this->specificCodes();
    }

    private function specificCodes()
    {
        Folder::all()
            ->each(function (Folder $folder) {
                $codes = Code::SPECIFIC_CODES[$folder->name];

                shuffle($codes);

                $i = 0;

                foreach ($codes as $code) {
                    Code::factory()
                        ->create([
                            'folder_id' => $folder->id,
                            'code' => $code,
                            'order' => $i,
                        ]);

                    $i = $i + 1;
                }
            });
    }

    private function randomcodes()
    {
        $numberOfCodes = count(Folder::NAMES) - 1;

        Folder::all()
            ->each(function (Folder $folder) use ($numberOfCodes) {
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
