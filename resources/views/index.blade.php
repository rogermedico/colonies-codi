<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        @vite('resources/js/app.js')
    </head>
    <body class="container bg-color-tertiari">
        <h1 class="my-4">Seguretat dels generadors</h1>

        <div class="row">
            @foreach ($folders as $folder)

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 shadow">

                    <form method="post" action="{{route('code.validate')}}">
                        @csrf
                        <input type="hidden" name="folder" value="{{$folder->id}}">
                        <input type="hidden" name="code" value="{{$folder->lastCodeNotSolved->id}}">
                        <div class="card-body">
                            <h4 class="card-title text-center">
                                {{$folder->name}}
                            </h4>
                            <ul>
                                <li>
                                    Pàgina: {{$folder->lastCodeNotSolved->page}}
                                </li>
                                <li>
                                    Fila: {{$folder->lastCodeNotSolved->row}}
                                </li>
                                <li>
                                    Columna: {{$folder->lastCodeNotSolved->column}}
                                </li>
                            </ul>
                            <div class="mb-3">
                                <label for="code-input-{{$folder->id}}" class="form-label">Introdueix el codi</label>
                                <input type="text" class="form-control" id="code-input-{{$folder->id}}" placeholder="ABC123" required>
                            </div>
                            <div class=" text-end">
                                    <button type="submit" class="card-link btn btn-primary">
                                        {{ __('Validar codi') }}
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer">
                                {{$folder->remaining_tries}} intents restants
                            </div>
                        </div>
                    </form>

            </div>
            @endforeach
        </div>

    </body>
</html>
