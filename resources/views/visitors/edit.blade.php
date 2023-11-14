@extends('layouts.panel')
@section('title', 'Editar visitante')
@section('content')
  <div class="card shadow">
    <div class="card-header border-1">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="mb-0">Editar información del visitante</h2>
        </div>
        <div class="col text-right">
          <a href="{{ route('visitors.index') }}" class="btn btn-sm btn-success">
            <i class="fas fa-chevron-left"></i>
            Regresar</a>
        </div>
      </div>
    </div>

    <div class="card-body">
      <form action="{{ route('visitors.update', $visitor) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label class="form-label" for="name">Nombre de la visita:</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $visitor->name) }}">
          @error('name')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label class="form-label" for="entity">Entidad:</label>
          <input type="text" name="entity" class="form-control" value="{{ $visitor->entity }}" readonly>
          @error('entity')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
        @if ($visitor->entity == 'Persona jurídica')            
        <div class="form-group">
          <label class="form-label" for="ruc">RUC:</label>
          <input type="text" name="ruc" class="form-control" maxlength="11" value="{{ old('ruc', $visitor->ruc) }}">
          @error('ruc')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
          {{-- <div id="mensajeruc" class="mt-2 py-1 pl-2 alert alert-danger error-alert">
            <i class="fas fa-exclamation-circle mr-1"></i>
            Ingrese un número de Ruc
          </div> --}}
        </div>
        @elseif ($visitor->entity == 'Persona natural')            
        <div class="form-group">
          <label class="form-label" for="dni">DNI:</label>
          <input type="text" name="dni" class="form-control" maxlength="8" value="{{ old('dni', $visitor->dni) }}">
          @error('dni')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
          {{-- <div id="mensajedni" class="mt-2 py-1 pl-2 alert alert-danger error-alert">
            <i class="fas fa-exclamation-circle mr-1"></i>
            Ingrese un número de DNI
          </div> --}}
        </div>
        @endif
        <div class="form-group">
          <label class="form-label" for="phone_number">Número de celular:</label>
          <input type="text" name="phone_number" maxlength="9" class="form-control" value="{{ old('phone_number', $visitor->phone_number) }}">
          @error('phone_number')
            <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
              <i class="fas fa-exclamation-circle mr-1"></i>
              <strong>{{ $message }}</strong>
            </div>
          @enderror
          {{-- <div id="mensajephone" class="mt-2 py-1 pl-2 alert alert-danger error-alert">
            <i class="fas fa-exclamation-circle mr-1"></i>
            Ingrese un número de Celular
          </div> --}}
        </div>
        <div class="form-group">
          <label class="form-label" for="email">Correo electrónico:</label>
          <input type="text" name="email" class="form-control" value="{{ old('email', $visitor->email) }}">
          @error('email')
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

@push('script')
    <script>
        // $(document).ready(function() {
            // const mdni = document.getElementById("mensajedni").hidden = true;
            // const mruc = document.getElementById("mensajeruc").hidden = true;
            // const mphone = document.getElementById("mensajephone").hidden = true;
            // document.querySelector("input[name='dni']").addEventListener("keyup", function() {
            //    return this.value = this.value.replace(/[^0-9]/g, "")
            // });
            // document.querySelector("input[name='ruc']").addEventListener("keyup", function() {
            //   return this.value = this.value.replace(/[^0-9]/g, "")
                  
            //     });
            // document.querySelector("input[name='phone_number']").addEventListener("keyup", function() {
            //   return this.value = this.value.replace(/[^0-9]/g, "")
                  
            //     });
        // });
    </script>
@endpush

<!-- Error handling script -->
@include('includes.form.error')
