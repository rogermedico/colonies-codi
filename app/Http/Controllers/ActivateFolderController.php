<?php

namespace App\Http\Controllers;

use App\Models\Folder;

class ActivateFolderController extends Controller
{
    public function __invoke(Folder $folder)
    {
        if (! $folder->solved()) {
            return back()->with(
                'error',
                'Abans de poder activar la <span class="fw-bold">'
                    . $folder->name
                    . '</span> has d\'introduir i validar tots els codis!'
            );
        }

        $folder->activateToggle();

        if ($folder->activated) {
            $alertType = 'message';
            $message = 'Interruptor de la <span class="fw-bold">'
            . $folder->name
            . '</span> activat, fase desbloquejada!';
        } else {
            $alertType = 'warning';
            $message = 'Interruptor de la <span class="fw-bold">'
            . $folder->name
            . '</span> desactivat, fase bloquejada!';
        }

        return back()->with($alertType, $message);
    }
}
