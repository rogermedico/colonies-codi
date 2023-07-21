<?php

namespace App\Http\Controllers;

use App\Models\Countdown;
use App\Models\Folder;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        if (Folder::allActivated()) {
            return view('activated')->with('message', 'Generadors activats!');
        }

        $folders = Folder::query()
            ->with('codes')
            ->get();

        $countdown = Countdown::getCountdown();

        return view('index', compact('folders', 'countdown'));
    }
}
