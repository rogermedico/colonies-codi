@extends('layout')

@section('end')
    <h1 class="my-4 text-center">
        ⚡ Seguretat dels generadors ⚡
    </h1>

    <h2 class="text-center">
        Generadors activats
    </h2>

    <video id="end-video" class="delay fade-in" controls loop preload="auto">
        <source src="{{asset('public/end.mp4')}}" type="video/mp4">
    </video>
@endsection
