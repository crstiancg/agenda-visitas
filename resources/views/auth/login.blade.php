@extends('layouts.form')

@section('title', 'Iniciar sesión')

@section('content')
  <div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-primary">

          <div class="card-body px-lg-5 py-lg-5">
            @if ($errors->any())
              <div class="text-center text-muted mb-2">
                <small>Se encontro el siguiente error</small>
              </div>
              <div class="alert alert-danger mb-4"
                role="alert">
                {{ $errors->first() }}
              </div>
            @else
              <div class="header-body text-center mb-2">
                <div class="row justify-content-center">
                  <div class="col-lg- col-md-10">
                    <h1 class="text-dark">@yield('title', 'Bienvenidos')</h1>
                  </div>
                </div>
              </div>
              <div class="text-center text-muted mb-4">
                <small>Ingresa tus credenciales para ingresar al sistema</small>
              </div>
            @endif

            <form role="form"
              method="POST"
              action="{{ route('login') }}">
              @csrf
              <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control"
                    name="email"
                    type="email"
                    value="{{ old('email', 'soporte@soporte.com') }}"
                    placeholder="Correo Electrónico"
                    required
                    autocomplete="email"
                    autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control"
                    name="password"
                    type="password"
                    placeholder="Contraseña"
                    required
                    @if (config('app.env') === 'local') value="soporte1" @endif>
                </div>
              </div>
              <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input"
                  id="remember"
                  name="remember"
                  type="checkbox"
                  {{ old('remember', 'checked') ? 'checked' : '' }}>
                <label class="custom-control-label"
                  for="remember">
                  <span class="text-muted">Recordar Sesión</span>
                </label>
              </div>
              <div class="text-center">
                <button class="btn btn-primary my-4"
                  type="submit">Empezar</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-3">
          {{-- <div class="col-6">
            <a class="text-dark"
              href="{{ route('password.request') }}"><small>¿Olvidaste tu contraseña?</small></a>
          </div> --}}
          {{-- <div class="col-6 text-right">
            <a class="text-dark"
              href="{{ route('register') }}"><small>Crear nueva cuenta </small></a>
          </div> --}}
        </div>
      </div>
    </div>
  </div>


@endsection
