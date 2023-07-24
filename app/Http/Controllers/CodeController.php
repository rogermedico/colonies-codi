<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeControllerValidateFormRequest;
use App\Models\Code;
use App\Models\Countdown;
use App\Models\Folder;
use Illuminate\Support\Str;

class CodeController extends Controller
{
    public function validateCode(CodeControllerValidateFormRequest $request)
    {
        $validated = $request->validated();

        $folder = Folder::query()
            ->with('codes')
            ->find($validated['folder']);

        $folder->removeTries();

        foreach ($folder->codes as $code) {
            if ($code->code === Str::upper($validated['guess'])) {
                $code->markAsSolved();

                if ($folder->solved()) {
                    Folder::addTriesToOtherFolders($folder);
                }

                if ($folder->remaining_tries !== 0) {
                    return back()->with(
                        'message',
                        'Codi validat!, et queden <span class="fw-bold">'
                            . $folder->remaining_tries
                            .'</span> intents'
                    );
                } else {
                    return back()->with(
                        'message',
                        'Codi validat!, però ja <span class="fw-bold">NO</span> et queden intents, no podras enviar solucions per la <span class="fw-bold">'
                            . $folder->name
                            . '</span> fins que n\'aconsegueixis més'
                    );
                }
            }
        }

        if ($folder->remaining_tries !== 0) {
            return back()->with(
                'error',
                'Codi erroni!, et queden <span class="fw-bold">'
                    . $folder->remaining_tries
                    .'</span> intents'
                );
        } else {
            return back()->with(
                'error',
                'Codi erroni!, <span class="fw-bold">NO</span> et queda cap intent, no podras enviar solucions per la <span class="fw-bold">'
                    . $folder->name
                    . '</span> fins que n\'aconsegueixis més'
                );
        }
    }

    public function reset()
    {
        Code::query()->update(['solved' => false]);

        Folder::query()->update([
            'remaining_tries' => count(Folder::NAMES) - 1,
            'activated' => false,
        ]);

        Countdown::reset();

        return to_route('index')->with('message', 'Tots els codis, intents i compte enrere resetejats');
    }

    public function showCodes()
    {
        $folders = Folder::query()
            ->with('codes')
            ->get();

        $countdown = Countdown::getCountdown();

        return view('admin_pannel', compact('folders', 'countdown'));
    }

    public function addTry(Folder $folder)
    {
        $folder->addTries();

        return back()->with(
            'message',
            'S\'ha sumat un intent a la carpeta <span class="fw-bold">'
                . $folder->name
                . '</span>, ara li queden <span class="fw-bold">'
                . $folder->remaining_tries
                .'</span> intents'
        );
    }

    public function removeTry(Folder $folder)
    {
        if ($folder->remaining_tries > 0) {
            $folder->removeTries();
        }

        if ($folder->remaining_tries !== 0) {
            $alertType = 'warning';
            $message = 'S\'ha restat un intent a la carpeta <span class="fw-bold">'
                . $folder->name
                . '</span>, ara li queden <span class="fw-bold">'
                . $folder->remaining_tries
                .'</span> intents';
        } else {
            $alertType = 'error';
            $message = 'S\'ha restat un intent a la carpeta <span class="fw-bold">'
                . $folder->name
                . '</span>, ara <span class="fw-bold">NO</span> li queda cap intent i no podrà enviar solucions fins que no aconsegueixi mes intents';
        }

        return back()->with($alertType, $message);
    }
}
