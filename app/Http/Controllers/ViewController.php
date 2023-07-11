<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $folders = Folder::all();

        foreach ($folders as $folder) {
            $folder->lastCodeNotSolved = $folder->getLastCodeNotSolved();
        };

        return view('index', compact('folders'));
    }
}
