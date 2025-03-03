<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ config('app.name') }} | @yield('title')
    </title>
    <!-- Favicon -->
    <link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
</head>

<body class="bg-gradient-default">
    <div class="main-content">
        <!-- Navbar -->
        <!-- Header -->
        <div class="header bg-gradient-white-70 py-6 py-lg-10">
        <div class="container">
    <div class="header-body text-center mb-6">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-20">
                <img alt="Logo Muninipio" src="{{ asset('img/theme/LogoMuni.png') }}" height="70">
                <h1 class="text-white">
                    Registro de visita
                    {{-- <small class="text-muted">Municipalidad - Puno</small> --}}
                  </h1>
                {{-- <b class="text-white ">Visitas MPP</b> --}}
            </div>
        </div>
    </div>
</div>

            {{-- <!-- <a href="http://actividades.munipuno.gob.pe/home">
                <img src="..\..\..\..\argon-dashboard-master\assets\img\theme\react.png" alt="Admin Logo" height="50">


                <b>Visitas</b>MPP

            </a> -->
            <!-- <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div> --> --}}
        </div>
        @yield('content')

        <!-- Footer -->
        <footer class="py-5">
            <div class="container">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            © OTI <a href="/" class="font-weight-bold ml-1">{{ config('app.name') }}</a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                            <li class="nav-item">
                                <a href="#" class="nav-link" target="_blank">¿Quiénes somos?</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!--   Core   -->
    <script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--   Optional JS   -->
    <!--   Argon JS   -->
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script src="{{ asset('js/argon-dashboard.min.js?v=1.1.2') }}"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
    </script>
</body>

</html>
