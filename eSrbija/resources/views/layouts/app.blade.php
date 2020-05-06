<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'eSrbija' }}</title>

    <!-- Scripts -->
    <!-- Izbrisao sam pozivanje app.js ovde jer nije radio logout -->
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <!-- include VueJS first -->
    <script src="https://unpkg.com/vue@latest"></script>

    <!-- use the latest vue-select release -->
    <script src="https://unpkg.com/vue-select@latest"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/662634c78e.js" crossorigin="anonymous"></script>

    {{--    Sweet alert JavaScript library--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel = "icon" href =
    "{{asset('icon.png')}}"
          type = "image/x-icon">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mojeankete.css') }}" rel="stylesheet">
    <link href="{{ asset('css/statistikaankete.css') }}" rel="stylesheet">
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
{{--                Created by Stefan Teslic--}}
{{--                Napravljeno zbog funkcionalnog prototipa--}}
{{--                Linije proveravaju na kojoj stranici se nalazimo --}}
{{--                da daju iluziju dobrog route-ovanja--}}
                <a class="navbar-brand" href=" @if(Request::path() === 'login' ||
                            Request::path() === 'register' ||
                            Request::path() === 'moderator/register' ||
                            Request::path() === 'user/register'||
                            Request::path() === 'verify' ||
                            Request::path() === 'password/reset')
                            {{ url('/') }}
                            @else
                            {{ url('/home') }}
                            @endif">
                    <img src="{{asset('grb.png')}}" alt="">
                    eSrbija

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" v-pre>

    {{--                                    This block of code sets the navbar name of current user

                                    @author Stefan Teslic
    --}}
                                @if(auth()->user()->isAdmin == true)
                                    Admin <span class="caret"></span>
                                @elseif(auth()->user()->isMod == true)
                                    {{auth()->user()->moderatori()->first()->naziv}} <span class="caret"></span>
                                @else
                                    {{auth()->user()->neprivilegovaniKorisnici()->first()->ime." ".auth()->user()->neprivilegovaniKorisnici()->first()->prezime}} <span class="caret"></span>
                                @endif

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        @if(auth()->user() != null && (auth()->user()->isAdmin == true && auth()->user()->isMod == true ))
            <script>
                function checkMod() {
                    $.ajax({
                        type: 'GET',
                        url: "/admin/moderator_request",
                        success: function (data) {
                            if(data.number > 0) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Imate '+data.number+' novih zahteva za moderatora!',
                                })
                            }

                        },
                    });
                }

                $(document).ready(function(){
                    setInterval(checkMod,5000);
                });
            </script>
        @endif
    </div>
</body>
</html>
