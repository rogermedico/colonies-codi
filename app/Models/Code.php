<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public const SPECIFIC_CODES = [
        'Carpeta vermella' => [
            'H9W3Q6',
            'V3S7R6',
            'T2V1D',
            'L3S9D2',
            'H5U2X3',
            'P6X2K7',
        ],
        'Carpeta blava' => [
            'S4A6Z',
            'P2R3F9',
            'G6F9S1',
            'M5T7Y4',
            'E4P7J5',
            'Y9H6T4',
        ],
        'Carpeta groga' => [
            'L5R7D9',
            'S6A1V2',
            'H6E7G1',
            'M1L4F2',
            'N7M6Z8',
            'P3R2X7',
        ],
        'Carpeta verda' => [
            'K9R3G1',
            'F1V5M7',
            'C8W3X2',
            'P7J9S8',
            'Q4K1D3',
            'P9T2Q7',
        ],
        'Carpeta marró' => [
            'P8R1C6',
            'Z4T6V5',
            'N2G3X8',
            'S2D8R',
            'F2U6P',
            'X8R4F3',
        ],
        'Carpeta blanca' => [
            'J1Z2F8',
            'L6N1F8',
            'M6L3R8',
            'C2X5J4',
            'R1T5H7',
            'Q6U2K8',
        ],
        'Carpeta lila' => [
            'L7D4B1',
            'Y5T2V8',
            'B4N2R1',
            'F1V5M7',
            'N8V7S2',
            'N9C3V',
        ],
    ];

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
