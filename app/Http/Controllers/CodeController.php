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

        $folder->remaining_tries = $folder->remaining_tries - 1;

        $folder->save();

        return back()->with('error', 'Codi erroni, et queden '. $folder->remaining_tries .' intents');
    }

    public function reset()
    {
        Code::query()->update(['solved' => false]);
        Folder::query()->update(['remaining_tries' => Folder::STARTING_TRIES]);

        return to_route('index')->with('message', 'Tots els codis resetejats');
    }

    public function showFolder(Folder $folder)
    {
        return response()->json($folder->codes()->get('code'));
    }
}
