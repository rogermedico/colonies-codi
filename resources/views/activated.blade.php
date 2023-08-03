@extends('layout')

@section('end')
    <h1 class="my-4 text-center">
        ⚡ Seguretat dels generadors ⚡
    </h1>

    <h2 class="text-center mb-3">
        Activant generadors: <span id="activation-countdown">0h 0m 12s</span>
    </h2>

    <div id="no-autorefresh" class="container text-center mt-3">
        <img id="activated-ko" src="{{asset('storage/pikachu_ko.png')}}" class="rounded-5">
        <img id="activated-ok" src="{{asset('storage/pikachu_ok.gif')}}" class="rounded-5 d-none">
    </div>

    {{-- <video id="end-video" class="delay fade-in" data-delay="15000" controls loop preload="auto">
        <source src="{{asset('storage/end.mp4')}}" type="video/mp4">
    </video> --}}
@endsection
