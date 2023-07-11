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

        $folder = Folder::find($validated['folder']);

        $code = Code::find($validated['code']);

        if ($code->code !== Str::upper($validated['guess'])) {
            $folder->remaining_tries = $folder->remaining_tries - 1;

            $folder->save();

            return back()->with('error', 'Codi erroni, et queden '. $folder->remaining_tries .' intents');
        }

        $code->solved = true;

        $code->save();

        return back()->with('message', 'Codi validat');

    }
}
