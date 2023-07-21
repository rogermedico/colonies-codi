<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countdown extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'finish',
    ];

    protected $casts = [
        'finish' => 'datetime',
    ];

    public function timeout(): bool
    {
        return now('Europe/Madrid')->gt($this->finish);
    }

    public static function getCountdown()
    {
        return self::first();
    }

    public static function reset()
    {
        self::getCountdown()
            ->update([
                'finish' => now('Europe/Madrid')->addHours(3),
            ]);
    }

    public static function addMinutes(int $minutes = 5)
    {
        $countdown = self::getCountdown();

        $countdown->update([
            'finish' => $countdown->finish->addMinutes($minutes),
        ]);
    }

    public static function subtractMinutes(int $minutes = 5)
    {
        $countdown = self::getCountdown();

        $countdown->update([
            'finish' => $countdown->finish->subMinutes($minutes),
        ]);
    }
}
