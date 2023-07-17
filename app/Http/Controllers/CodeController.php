<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeControllerValidateFormRequest;
use App\Models\Code;
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
                $code->solved = true;

                $code->save();

                if ($folder->solved()) {
                    Folder::addTriesToOtherFolders($folder);
                }

                return back()->with('message', 'Codi validat');
            }
        }

        return back()->with('error', 'Codi erroni, et queden '. $folder->remaining_tries .' intents');
    }

    public function reset()
    {
        Code::query()->update(['solved' => false]);

        Folder::query()->update(['remaining_tries' => count(Folder::NAMES) - 1]);

        return to_route('index')->with('message', 'Tots els codis resetejats');
    }

    public function showCodes()
    {
        $folders = Folder::query()
            ->with('codes')
            ->get();

        return view('solutions', compact('folders'));
    }

    public function addTry(Folder $folder)
    {
        if ($folder->remaining_tries === 0) {
            $folder->addTries();
        }

        return back();
    }

    public function removeTry(Folder $folder)
    {
        if ($folder->remaining_tries !== 0) {
            $folder->removeTries();
        }

        return back();
    }
}
