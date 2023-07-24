<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'page',
        'row',
        'column',
        'code',
        'order',
        'solved',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function markAsSolved()
    {
        $this->solved = true;

        $this->save();
    }

    public function solvedToggle(): void
    {
        $this->solved = $this->solved ? false : true;

        $this->save();
    }

    public static function getLastNotSolved()
    {
        return self::query()
            ->with('group')
            ->where('solved', false)
            ->orderBy('order', 'asc')
            ->first();
    }
}
