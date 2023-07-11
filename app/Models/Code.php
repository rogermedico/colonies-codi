<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Group::class);
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
