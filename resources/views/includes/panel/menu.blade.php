@php
  function is_active($expression)
  {
    $expression = $expression . '*';
    return request()->is($expression) ? 'active' : '';
  }

  function is_admin()
  {
    return optional(auth()->user())->role === 'admin' ? '' : 'd-none';
  }
@endphp

<!-- Heading -->
<h6 class="navbar-heading text-muted mt--4">Gestión</h6>
<ul class="navbar-nav">
  <li class="nav-item {{ is_active('home') }}">
    <a class="nav-link {{ is_active('home') }}"
      href="{{ route('home') }}">
      <i class="fas fa-calendar-alt text-danger"></i> Calendario
    </a>
  </li>
  <li class="nav-item {{ is_active('visits') }}">
    <a class="nav-link {{ is_active('visits') }}"
      href="{{ route('visits.index') }}">
      {{-- <i class="fas fa-calendar-alt text-blue"></i> Visitas --}}
      {{-- icono de tabla --}}
      <i class="fas fa-table text-blue"></i> Visitas
    </a>
  </li>
  <li class="nav-item {{ is_active('secretaries') }} {{ is_admin() }}">
    <a class="nav-link {{ is_active('secretaries') }}"
      href="{{ route('secretaries.index') }}">
      <i class="fas fa-female text-info"></i> Secretarias
    </a>
  </li>
  <li class="nav-item {{ is_active('visitors') }} {{ is_admin() }}">
    <a class="nav-link {{ is_active('visitors') }}"
      href="{{ route('visitors.index') }}">
      <i class="far fa-id-badge text-yellow"></i> Visitantes
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link"
      href="{{ route('logout') }}"
      onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="fas fa-sign-in-alt"></i> Cerrar sesión
    </a>
    <form id="formLogout"
      style="display: none;"
      action="{{ route('logout') }}"
      method="POST">
      @csrf
    </form>
  </li>
</ul>
<!-- Divider -->
{{-- <hr class="my-3"> --}}
<!-- Heading -->
{{-- <h6 class="navbar-heading text-muted">Reportes</h6> --}}
{{-- <h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
{{-- <ul class="navbar-nav mb-md-3">
  <li class="nav-item {{ is_active('reports') }}">
    <a class="nav-link {{ is_active('reports') }}"
      href="#">
      <i class="ni ni-books text-default"></i> Citas
    </a>
  </li>
</ul> --}}
