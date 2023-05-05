<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ConnectMe') }}</title>

        @include('layouts.partials._styles')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
    @include('layouts.partials._navbar')
    <div class="container-fluid">
            <div class="row">
                {{-- user dashboard content --}}
                @yield('user-dashboard')
            </div>
    </div>

    @include('layouts.partials._scripts')
    </body>
</html>
