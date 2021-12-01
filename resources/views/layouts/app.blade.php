<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images') }}/favicon.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expetr expense traking and analysis') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar container navbar-expand-md flex bg-white">
            <div><a class="navbar-brand mx-2 " href="{{ route('loggedin?') }}"><img
                        src="{{ asset('images/logo.svg') }}" class="img-responsive sm-none" width="150px" alt="">
                    <img src="{{ asset('images/favicon.svg') }}" class="img-responsive lg-none" width="50px" alt="">
                </a></div>
            @if (Auth::check())
                <button class="btn btn-primary mx-4 py-2 font-weight-bold text-light"
                    onclick="window.location = '{{ route('dashboard') }}'">
                    Go To Dashboard
                </button>
            @else
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <img src="{{ asset('images/menu.svg') }}" alt="">
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link text-primary" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-primary mx-4 py-2 font-weight-bold text-light"
                                onclick="window.location = '{{ route('welcome') }}'">
                                Try it now
                            </button>
                        </li>
                    </ul>

                </div>

            @endif
        </nav>
        @yield('content')
    </div>
    {{-- <style>
            .logo{
                width: fit-content;
                margin: auto;
            }
            .logo img{
             width: 120px;
            }
        </style> --}}
    <footer class="footer text-center text-muted">
        <small>&copy;{{ Date('Y') }} Expetr business management system</small>
    </footer>
</body>

</html>
