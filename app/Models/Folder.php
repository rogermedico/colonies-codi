<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public const NAMES = [
        'Carpeta vermella',
        'Carpeta blava',
        'Carpeta groga',
        'Carpeta verda',
        'Carpeta marró',
        'Carpeta blanca',
        'Carpeta lila',
    ];

    protected $fillable = [
        'name',
        'remaining_tries',
        'activated',
    ];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function solved()
    {
        $numberOfCodesNotSolved = $this->codes()
            ->where('solved', false)
            ->count();

        return $numberOfCodesNotSolved === 0;
    }

    public function addTries(int $tries = 1): void
    {
        $this->remaining_tries = $this->remaining_tries + $tries;

        $this->save();
    }

    public function removeTries(int $tries = 1): void
    {
        $this->remaining_tries = $this->remaining_tries - $tries;

        $this->save();
    }

    public function activateToggle(): void
    {
        $this->activated = $this->activated ? false : true;

        $this->save();
    }

    public static function addTriesToOtherFolders(Folder $folder)
    {
        $folders = self::query()
            ->where('id', '!=', $folder->id)
            ->get();

        foreach ($folders as $folder) {
            if (! $folder->solved()) {
                $folder->remaining_tries++;

                $folder->save();
            }
        }
    }

    public static function allActivated(): bool
    {
        $numberOfDeactivatedFolders = self::query()
            ->where('activated', false)
            ->count();

        return $numberOfDeactivatedFolders === 0;
    }
}
