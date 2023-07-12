<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $folders = Folder::query()
            ->with('codes')
            ->get();

        return view('index', compact('folders'));
    }
}
