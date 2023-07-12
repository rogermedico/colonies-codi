<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public const STARTING_TRIES = 3;

    protected $fillable = [
        'name',
        'remaining_tries',
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
}
