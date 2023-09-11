<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ Vite::asset('resources/img/logo.png') }}" type="image/x-icon">
    <title>Portfolio | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Style --}}
    <style>
        body {
            display: none;
        }
    </style>

    {{-- Cdns --}}

    @yield('cdns')

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>

<body class="d-flex">
    {{-- Header --}}
    <div id="app" class="header">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="p-2">
                <a class="navbar-brand d-flex align-items-center m-0" href="{{ url('/') }}">
                    <div class="logo_laravel">
                        <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="">
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="flex-grow-1 d-flex">
                <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto flex-grow-1 w-100 d-flex flex-column text-center">
                        <li class="nav-item d-flex flex-column fs-3">
                            <a class="nav-link  @if (Route::is('guest.index')) active @endif"
                                href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link @if (Route::is('admin.projects*')) active @endif"
                                    href="{{ route('admin.projects.index') }}">Projects</a>
                            </li>
                        @endauth
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item
                            btn-group dropend">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.projects.index') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            {{-- Icons --}}
            <div class="my-3">
                <i class="fa-brands fa-facebook fa-2x"></i>
                <i class="fa-brands fa-linkedin fa-2x"></i>
                <i class="fa-brands fa-github fa-2x"></i>
            </div>
        </nav>
    </div>
    {{-- Main --}}
    <main id="main-guest">
        @include('includes.allert')
        @yield('content')
    </main>

    {{-- Scripts --}}
    @yield('scripts')
</body>

</html>
