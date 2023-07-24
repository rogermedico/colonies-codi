<?php

namespace App\Http\Controllers;

use App\Models\Code;

class SolveCodeController extends Controller
{
    public function __invoke(Code $code)
    {
        $code->solvedToggle();

        if ($code->solved) {
            $alertType = 'message';
            $message = '<span class="fw-bold">Codi '
                . $code->order
                . '</span> de la <span class="fw-bold">'
                . $code->folder->name
                . '</span> marcat com a vàlid';
        } else {
            $alertType = 'warning';
            $message = '<span class="fw-bold">Codi '
                . $code->order
                . '</span> de la <span class="fw-bold">'
                . $code->folder->name
                . '</span> marcat com a invàlid';
        }

        return back()->with($alertType, $message);
    }
}
