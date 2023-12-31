@extends('layout')

@section('content')
    <h1 class="my-4 text-center">
        ⚡ Seguretat dels generadors (Admin) ⚡
    </h1>

    <h2 class="text-center">
        Compte enrere: <span id="count-down" data-finish-date="{{$countdown->finish}}"></span>
    </h2>
    <div class="mb-4 text-center">
        <a class="btn btn-outline-danger" href="{{route('countdown.reset')}}">
            Establir per d'aquí 3h
        </a>
        <a class="btn btn-outline-danger" href="{{route('countdown.reset.minute')}}">
            Establir per d'aquí 1m
        </a>
        <a class="btn btn-primary" href="{{route('countdown.minutes.subtract', 1)}}">
            Restar 1m
        </a>
        <a class="btn btn-primary" href="{{route('countdown.minutes.add', 1)}}">
            Afegir 1m
        </a>
    </div>

    <x-messages/>

    <div class="row">
        @foreach ($folders as $folder)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 shadow">

                    <div class="card-body">
                        <h4 class="card-title text-center">
                            {{$folder->name}}
                        </h4>

                        <ul class="list-group list-group-flush mb-3">
                            @foreach ($folder->codes as $code)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    {{$code->code}}
                                    @if ($code->solved)
                                        <a href="{{route('code.solve.toggle', $code)}}">
                                            <i class="fa-solid fa-check text-success"></i>
                                        </a>
                                    @else
                                        <a href="{{route('code.solve.toggle', $code)}}">
                                            <i class="fa-solid fa-question"></i>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @if($folder->solved())
                            <div class="text-end">
                                <span class="card-link btn btn-success">
                                    {{ __('Carpeta resolta!') }}
                                </span>
                            </div>
                        @else
                            <div class="d-flex justify-content-between">
                                <div class="flex">
                                    <form method="post" action="{{route('folder.removeTry', $folder)}}">
                                        @csrf
                                        <button type="submit" class="card-link btn btn-outline-danger" @disabled($folder->remaining_tries <= 0)>
                                            {{ __('Eliminar un intent') }}
                                        </button>
                                    </form>
                                </div>
                                <div class="flex">
                                    <form method="post" action="{{route('folder.addTry', $folder)}}">
                                        @csrf
                                        <button type="submit" class="card-link btn btn-primary">
                                            {{ __('Afegir un intent') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="card-footer">
                        {{$folder->remaining_tries}} intents restants
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
