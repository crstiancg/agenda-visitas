@extends('layouts.panel')
@section('title', 'Añadir nueva secretaria')
@section('content')
  <div class="card shadow">
    <div class="card-header border-1">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="mb-0">Editar datos de la secretaria</h2>
        </div>
        <div class="col text-right">
          <a href="{{ route('secretaries.index') }}" class="btn btn-sm btn-success">
            <i class="fas fa-chevron-left"></i>
            Regresar</a>
        </div>
      </div>
    </div>

    <div class="card-body">
      <form action="{{ route('secretaries.update', $secretary) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label class="form-label" for="name">Nombre de la secretaria:</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $secretary->name) }}">
          @error('name')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="email">Correo electrónico:</label>
          <input type="text" name="email" class="form-control" value="{{ old('email', $secretary->email) }}">
          @error('email')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Contraseña:</label>
          <input type="password" name="password" class="form-control" id="password">
          @error('password')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-sm btn-primary">Actualizar visita</button>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $('#password')
        .one('focus', function() {
          $(this).select();
        })
        .one('input', function(event) {
          $(this).attr('type', 'password');
        });
    })
  </script>
@endsection

<!-- Error handling script -->
@include('includes.form.error')
