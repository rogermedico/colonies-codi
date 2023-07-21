@extends('layout')

@section('end')
    <h1 class="my-4 text-center">
        ⚡ Seguretat dels generadors ⚡
    </h1>

    <h2 class="text-center">
        Generadors activats
    </h2>

    <video id="end-video" class="delay fade-in" data-delay="15000" controls loop preload="auto">
        <source src="{{asset('storage/end.mp4')}}" type="video/mp4">
    </video>
@endsection
