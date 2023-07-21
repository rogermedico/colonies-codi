@extends('layout')

@section('content')
    <h1 class="my-4 text-center">
        ⚡ Seguretat dels generadors ⚡
    </h1>

    <h2 class="my-4 text-center">
        Compte enrere: <span id="count-down" data-finish-date="{{$countdown->finish}}"></span>
    </h2>

    <x-messages/>

    @if (! $countdown->timeout())
        <div class="row">
            @foreach ($folders as $folder)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100 shadow">

                        <div class="card-body">
                            <h4 class="card-title text-center">
                                {{$folder->name}}
                            </h4>
                            @if (! $folder->solved())
                                @if(app()->environment('local'))
                                    <div class="d-flex justify-content-around mb-3">
                                        @foreach ($folder->codes as $code)
                                            <div class="text-center" style="font-size:.80rem;">
                                                <div>
                                                    {{$code->code}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="d-flex justify-content-around mb-3">
                                    @foreach ($folder->codes as $code)
                                        <div class="text-center">
                                            @if ($code->solved)
                                                <i class="fa-solid fa-check text-success"></i>
                                            @else
                                                <i class="fa-solid fa-question"></i>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <form class="validate-code-form" method="post" action="{{route('code.validate')}}">
                                    @csrf
                                    <input type="hidden" name="folder" value="{{$folder->id}}">
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
                                </form>
                            @else
                                <p>
                                    Tots els codis d'aquesta carpeta validats ✅. Activa l'interruptor per desbloquejar 🔓 aquesta fase del generador.
                                </p>
                                <div class="text-center mb-3">
                                    <label class="rocker">
                                        <input class="activate-folder-switch" type="checkbox" @checked($folder->activated) data-callback-url="{{route('folder.activate.toggle', $folder->id)}}">
                                        <span class="switch-left">On</span>
                                        <span class="switch-right">Off</span>
                                    </label>
                                </div>
                            @endif
                        </div>
                        @if (! $folder->solved())
                            <div class="card-footer">
                                {{$folder->remaining_tries}} intents restants
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loadingModal" aria-hidden="true">
            <div  class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title fs-4 w-100">🔍 Comprovant codi</h5>
                    </div>
                    <div class="modal-body text-center my-5">
                        <div class="lds-roller text-color-success"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="activateFolderLoadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="activateFolderLoadingModal" aria-hidden="true">
            <div  class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 id="activate-folder-loading-modal-title" class="modal-title fs-4 w-100"></h5>
                    </div>
                    <div class="modal-body text-center my-5">
                        <div class="lds-roller text-color-success"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
