<?php

namespace App\Http\Controllers;

use App\Models\Countdown;

class CountdownController extends Controller
{
    public function reset()
    {
        Countdown::reset();

        return back()->with('message', 'Compte enrere establert per d\'aquí <span class="fw-bold">3 hores</span>');
    }

    public function setToOneMinute()
    {
        Countdown::setToOneMinute();

        return back()->with('message', 'Compte enrere establert per d\'aquí <span class="fw-bold">1 minut</span>');
    }

    public function addMinutes(int $minutes)
    {
        Countdown::addMinutes($minutes);

        return back()->with('message', 'S\'han afegit <span class="fw-bold">'. $minutes .' minuts</span> al compte enrere');
    }

    public function subtractMinutes(int $minutes)
    {
        Countdown::subtractMinutes($minutes);

        return back()->with('warning', 'S\'han restat <span class="fw-bold">'. $minutes .' minuts</span> al compte enrere');
    }
}
