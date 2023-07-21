<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // partially solve two more folders
        //$this->partiallySolve();

        // fully solve one folder
        $this->fullSolve();
    }

    private function partiallySolve()
    {
        // fully solve one folder
        Folder::inRandomOrder()
            ->take(1)
            ->first()
            ->codes
            ->each(fn (Code $code) => $code->markAsSolved());

        // partially solve two more folders
        Folder::inRandomOrder()
            ->take(2)
            ->get()
            ->each(fn (Folder $folder) => $folder->codes
                ->random(intval(floor((count(Folder::NAMES) - 1) / 2)))
                ->each(fn (Code $code) => $code->markAsSolved()));
    }

    private function fullSolve()
    {
        Folder::query()
            ->get()
            ->each(fn (Folder $folder) => $folder->codes
                ->each(fn (Code $code) => $code->markAsSolved()));

        Folder::inRandomOrder()
            ->take(count(Folder::NAMES) - 1)
            ->get()
            ->each(fn (Folder $folder) => $folder->activateToggle());
    }
}
