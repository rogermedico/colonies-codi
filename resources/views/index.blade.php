<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name')}}</title>

        @vite('resources/js/app.js')
    </head>
    <body class="container bg-color-tertiari">
        <h1 class="my-4 text-center">
            ⚡ Seguretat dels generadors ⚡
        </h1>

        <x-messages/>

        <div class="row">
            @foreach ($folders as $folder)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 shadow">

                    <form method="post" action="{{route('code.validate')}}">
                        @csrf
                        <input type="hidden" name="folder" value="{{$folder->id}}">
                        <div class="card-body">
                            <h4 class="card-title text-center">
                                {{$folder->name}}
                            </h4>
                            <div class="d-flex justify-content-around mb-3">
                                @foreach ($folder->codes as $code)
                                    <div class="text-center">
                                        @if(app()->environment('local'))
                                            <div>
                                                {{$code->code}}
                                            </div>
                                        @endif
                                        @if ($code->solved)
                                            <i class="fa-solid fa-check text-success"></i>
                                        @else
                                            <i class="fa-solid fa-question"></i>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="code-input-{{$folder->id}}" class="form-label">Introdueix un codi</label>
                                @if ($folder->solved())
                                    <input type="text" class="form-control" id="code-input-{{$folder->id}}" name="guess" placeholder="ABC123" required disabled>
                                @else
                                    <input type="text" class="form-control" id="code-input-{{$folder->id}}" name="guess" placeholder="ABC123" required>
                                @endif
                            </div>
                            <div class=" text-end">
                                    @if ($folder->solved())
                                        <span class="card-link btn btn-success">
                                            {{ __('Tot resolt!') }}
                                        </span>
                                    @elseif ($folder->remaining_tries > 0)
                                        <button type="submit" class="card-link btn btn-primary">
                                            {{ __('Validar codi') }}
                                        </button>
                                    @else
                                        <button type="submit" class="card-link btn btn-primary disabled">
                                            {{ __('Validar codi') }}
                                        </button>
                                    @endif
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

        <div class="lds-roller text-color-success d-none"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

    </body>
</html>
