<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ConnectMe</title>

    @include('layouts.partials._styles')
</head>
<body class="background-color">
    <div class="home-page">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="content">
                        <p class="title">Connect Me</p>
                        <p class="description">A system for matching up travellers headed for neighbouring or similar destinations</p>
                    </div>
                    <div class="d-grid gap-2 d-md-flex home-btn">
                        <a class="btn me-md-4" href="{{ route('login') }}" id="login-btn">Login</a>
                        <a class="btn" href="{{ route('register') }}" id="register-btn">Register</a>
                    </div>
                </div>
                <div class="col-6">
                    <img src="{{ asset('img/img1.png') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#D9E2FF" fill-opacity="1" d="M0,0L48,32C96,64,192,128,288,176C384,224,480,256,576,224C672,192,768,96,864,48C960,0,1056,0,1152,10.7C1248,21,1344,43,1392,53.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</body>
</html>
