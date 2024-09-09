<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #273746 ">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    EventLink
                </a>
                <div class="d-flex flex-grow-1 justify-content-center">
                    @auth
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item">
                                <a class="nav-link active fw-bolder" aria-current="page" href="{{ route('event.index') }}">Event</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active fw-bolder" aria-current="page" href="{{ route('attendes.index') }}">Peserta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active fw-bolder" aria-current="page" href="{{ route('tiket.index') }}">Tiket</a>
                            </li>
                            <li class="nav-item ms-auto"> <!-- Tambahkan ms-auto di sini -->
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <button class="btn dropdown-toggle fw-bolder " style="color: white" data-bs-toggle="dropdown" aria-expanded="false">
                                                Opsi
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark ">
                                                <li class="nav-item">
                                                    <a class="nav-link active" aria-current="page" href="{{ route('venues.index') }}">Pemilik Event</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" aria-current="page" href="{{ route('artiss.index') }}">Artis</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" aria-current="page" href="{{ route('categoris.index') }}">Katageori Event</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" aria-current="page" href="{{ route('sponsors.index') }}">Sponsor</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
            <ul class="navbar-nav ms-auto" >

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" style="color: white" href="{{ route('login') }}">Masuk</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link"style="color: white" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" style="color: white" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                Keluar
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
    </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>
