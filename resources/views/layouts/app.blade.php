<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('css/side_menu.css') }}" rel="stylesheet">

</head>
<body>
    <div id="laravel_app" class="h-100">
        <div class="col h-100">
            <div class="row">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #5d69b3;">
                    <div class="container ">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src=" {{ asset("images/travellers-logo.png") }}" width="200px" alt="" class="img-fluid">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-light m-2" href="{{ route('login.view') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-light m-2" href="{{ route('register.view') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                    @csrf
                                    <button type="submit" class="btn btn-light" >
                                        {{-- {{ Auth::user()->name }} --}}
                                        Logout
                                    </button>
                                </form>
                                    {{-- <li class="nav-item dropdown">



                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </div>
                                    </li> --}}
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row h-100">
                <main class="">
                    @yield('content')
                </main>
            </div>
            <div class="row">

                <!-- Footer -->
                <footer id="main_footer" class="sticky-footer bg-white">
                    <div class="copyright_container ">
                        <div class="copyright text-center p-1" style="color:rgb(255, 255, 255); background-color:#5d69b3">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ mix("js/app.js")}}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset("js/side_menu.js")}}"></script>

</body>
</html>
