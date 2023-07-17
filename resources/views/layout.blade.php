<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name')}}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{url('storage/favicons/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('storage/favicons/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('storage/favicons/favicon-16x16.png')}}">
        <link rel="manifest" href="/site.webmanifest">

        @vite('resources/js/app.js')
    </head>
    <body class="container bg-color-tertiari">
        @yield('content')
    </body>
</html>
