<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ config('app.name') }} - @yield('title')
    </title>
    <!-- Favicon -->
    <link type="image/png"
        href="{{ asset('img/brand/favicon.png') }}"
        rel="icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
        rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}"
        rel="stylesheet" />
    <!-- Choices JS Styles-->
    <link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
        rel="stylesheet" />
    @if (Route::is('visits.create') || Route::is('visits.edit'))
        <!-- Bootstrap Datepicker CSS files -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
            rel="stylesheet">
    @endif

    <style>
        .choices__inner {
            background-color: white;
        }

        button[disabled] {
            cursor: not-allowed;
        }

        [x-cloak] {
            display: none !important;
        }

        .card-header {
            margin-top: 5px;
        }

        /**
        * TODO: make the styles more specific so they don't affect non related elements (e.g. the calendar)
        */
        /* table {
            margin-top: 15px;
        }

        th {
            color: white;
            font-family: Arial, Helvetica, sans-serif;

        }*/


        .thead-color-portal {
            background-color: #3A83C3;
            color: white;


        }
        .logo {
            height: 80px;
            width: 200px;
            padding-bottom: 20px;
        }



        .linea-vertical {
            border-left: 3px solid black;
            /* Establece una línea sólida de 1 píxel de ancho y color negro */
            height: 50px;
            /* Establece la altura deseada para la línea vertical */
        }

        /**
        *TODO make the styles more specific so they don't affect non related elements (e.g. the calendar)
        */
        .custom_hr {
            border-color: black;
            border-style: solid;
            font-weight: bold;
            margin-top: -70px;
            margin-left: 1%;
            margin-bottom: -0px;
        }

        /* .subtitle {

            font-family: Arial, Helvetica, sans-serif;
            font-size: 4vmin;
            vertical-align: middle;
            color: #ABA2A2;
            padding-top: 6px;
        } */

        .container {
            display: flex;
            /* Establece un contenedor flexible */
            justify-content: left;
            /* Distribuye los elementos horizontalmente */
            gap: 10px;
            margin-top: -3%;
            margin-left: 10px;
        }
    </style>
    <!-- Alpine Core -->
    <script defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="">
    @auth
        <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white"
            id="sidenav-main">
            {{-- Change max width 150px --}}
            {{-- <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main" --}}
            {{-- style="max-width: 200px !important;"> --}}
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler"
                    data-toggle="collapse"
                    data-target="#sidenav-collapse-main"
                    type="button"
                    aria-controls="sidenav-main"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->

                <a class="navbar-brand pt-1"
                    href="#">
                    <img class="h-auto w-100"
                        src="{{ asset('img/brand/logo_visitasMPP.png') }}"
                        alt="..."
                        style="max-height: 200px; max-width: 180px;">
                </a>



                <!-- User -->
                <ul class="nav align-items-center d-md-none">
                    {{-- <li class="nav-item dropdown">
            <a class="nav-link nav-link-icon"
              data-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="true"
              aria-expanded="false">
              <i class="ni ni-bell-55"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
              aria-labelledby="navbar-default_dropdown_1">
              <a class="dropdown-item"
                href="#">Action</a>
              <a class="dropdown-item"
                href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item"
                href="#">Somethig else here</a>
            </div>
          </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link"
                            data-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img src="{{ asset('img/theme/team-5-800x800.jpg') }}"
                                        alt="Image placeholder">
                                </span>
                            </div>
                        </a>
                        @include('includes.panel.userOptions')
                    </li>
                </ul>
                <!-- Collapse -->
                <div class="collapse navbar-collapse "
                    id="sidenav-collapse-main">
                    <!-- Collapse header -->
                    <div class="navbar-collapse-header d-md-none">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="./index.html">
                                    <img class="h-auto w-100"
                                    src="{{ asset('img/brand/logo_visitasMPP.png') }}"
                                    alt="..."
                                    style="max-height: 200px; max-width: 180px;">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button class="navbar-toggler"
                                    data-toggle="collapse"
                                    data-target="#sidenav-collapse-main"
                                    type="button"
                                    aria-controls="sidenav-main"
                                    aria-expanded="false"
                                    aria-label="Toggle sidenav">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    @include('includes.panel.menu')
                </div>
            </div>
        </nav>
    @endauth
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark"
            id="navbar-main">
            <div class="container-fluid">
                <div></div>
                <!-- Form -->
                {{-- @if (request()->is('home*'))
          <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
          </form>
        @endif --}}
                <!-- User -->
                @auth
                    <ul class="navbar-nav align-items-center d-none d-md-flex">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0"
                                data-toggle="dropdown"
                                href="#"
                                role="button"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img src="{{ asset('img/theme/team-5-800x800.jpg') }}"
                                            alt="Image placeholder">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span
                                            class="mb-0 text-sm font-weight-bold">{{ auth()->guest() ? 'Invitado' : auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            @include('includes.panel.userOptions')
                        </li>
                    </ul>



                @endauth

            </div>
        </nav>


        <!-- End Navbar -->
        <!-- Header -->
        @auth
            <div class="header bg-gradient-info pb-8 pt-4 pt-md-6">

            </div>
        @endauth


        @guest()


            <div class="header bg-gradient-white pb-8 pt-4 pt-md-6">
                <div class="container">
                    <div class="element">
                        <img class="logo"src="img/brand/logo_visitasMPP.png"
                            alt="logo visitas">
                    </div>
                    <div class="element">
                        <div class="linea-vertical"></div>
                    </div>
                    <div class="element">
                        <h2 style="font-family: Arial, Helvetica, sans-serif;
                        font-size: 4vmin;
                        vertical-align: middle;
                        color: #ABA2A2;
                        padding-top: 6px;">Registro de Visitas</h2>
                    </div>


                </div>

                <div class="linea-vertical"></div>
                <hr class="custom_hr">
            </div>
        @endguest


        <div class="container-fluid mt--7">
            @yield('content')
            <!-- Footer -->
            @include('includes.panel.footer')
        </div>
    </div>


    <!--   Core   -->
    <script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--   Optional JS   -->
    <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
    <!--   Argon JS   -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=1.1.2') }}"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
    </script>
    <!-- Include Choices JavaScript (latest) -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Bootrap Datepicker JS files-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <!-- Moment.js Spanish locale file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>
    <!-- Full Calendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    @stack('script')
</body>

</html>
