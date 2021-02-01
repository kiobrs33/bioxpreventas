<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link href="{{ asset('bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{asset('bootstrap4/js/bootstrap.min.js')}}"></script>


    <title>Biox</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-expand-md navbar-light" style="background-color:#75BAFF;">
        <a class="navbar-brand" href="#">BIOX INICIO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                @if (Route::has('login'))
                @auth
                @if(Auth::user()->name == "employee")
                <li class="nav-item"><a class="nav-link" href="{{ route('trabajador.home') }}"><b>Panel de
                            Control</b></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b>Trabajador</b> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                @elseif(Auth::user()->name == "admin")
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><b>Panel de Control</b></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b>Administrador</b> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                @endif
                @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li> -->
                @endauth
                @endif
            </ul>
        </div>

    </nav>


    <div class="container">
        <h2 class="mt-4">BIOX PÉRU</h2>
        <p>
            BIOX, es una empresa 100% Arequipeña, que nace en el año 2014, dedicada principalmente a la obtención de
            Colágeno Hidrolizado, para incorporarlo como ingrediente activo en: Formulaciones alimenticias.Suplementos y
            Complementos alimenticios.
        </p>
    </div>
</body>

</html>