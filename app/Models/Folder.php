<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public const MAX_PAGES = 5;
    public const MAX_ROWS = 20;
    public const MAX_COLUMNS = 4;

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function getLastCodeNotSolved()
    {
        return $this->codes()
            ->where('solved', false)
            ->orderby('order', 'asc')
            ->first();
    }
}
