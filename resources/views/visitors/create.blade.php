@extends('layouts.panel')
@section('title', 'Añadir nuevo secretario')
@section('content')
    <div class="card shadow">
        <div class="card-header border-1">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="mb-0">Registrar nuevo visitante</h2>
                </div>
                <div class="col text-right">
                    <a href="{{ route('visitors.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i>
                        Regresar</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('visitors.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="name">Nombre del visitante:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" form="entity">Seleccionar entidad:
                        <span class="text-red">*</span>
                    </label>
                    <select class="form-control" id="entity" name="entity" readonly>
                        @foreach ($entities as $entity)
                            <option value="{{ $entity }}" {{ old('entity') === $entity ? 'selected' : '' }}>
                                {{ $entity }}
                            </option>
                        @endforeach
                    </select>
                    <div class="d-none" id="modal_error_entity">
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong id="modal_error_message_entity"></strong>
                        </div>
                    </div>
                </div>
                <div class="form-group d-none" id="ruc_display">
                    <label class="form-label" for="ruc">RUC:</label>
                    <input type="text" name="ruc" class="form-control" id="ruc" maxlength="11" value="{{ old('ruc') }}">
                    @error('ruc')
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div id="mensajeruc" class="mt-2 py-1 pl-2 alert alert-danger error-alert">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Ingrese un número de Ruc
                    </div>
                </div>
                <div class="form-group" id="dni_display">
                    <label class="form-label" for="dni">DNI:</label>
                    <input type="text" name="dni" class="form-control" id="dni" maxlength="8" value="{{ old('dni') }}">
                    @error('dni')
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div id="mensajedni" class="mt-2 py-1 pl-2 alert alert-danger error-alert">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Ingrese un número de DNI
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone_number">Número de celular (opcional):</label>
                    <input type="text" name="phone_number" class="form-control" maxlength="9"
                        value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div id="mensajephone" class="mt-2 py-1 pl-2 alert alert-danger error-alert">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Ingrese un número de Celular
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Correo electrónico (opcional):</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Crear visitante</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Show or hide RUC input
        $('#entity').on('change', function() {
          if (this.value === 'Persona jurídica') {
              $('#ruc_display').removeClass('d-none');
              $('#ruc').prop('disabled', false);
              $('#dni_display').addClass('d-none');
              $('#dni').prop('disabled', true);
          } else {
              $('#ruc_display').addClass('d-none');
              $('#ruc').prop('disabled', true);
              $('#dni_display').removeClass('d-none');
              $('#dni').prop('disabled', false);
          }
        });

        // Execute at least once
        $('#entity').trigger('change');


        $(document).ready(function() {
            const mdni = document.getElementById("mensajedni").hidden = true;
            const mruc = document.getElementById("mensajeruc").hidden = true;
            const mphone = document.getElementById("mensajephone").hidden = true;
            document.querySelector("input[name='dni']").addEventListener("keyup", function() {
                if (this.value = this.value.replace(/[^0-9]/g, "")) {
                    const m = document.getElementById("mensajedni").hidden = true;
                } else {
                    const m = document.getElementById("mensajedni").hidden = false;
                }
            });
            document.querySelector("input[name='ruc']").addEventListener("keyup", function() {
                if (this.value = this.value.replace(/[^0-9]/g, "")) {
                    const m = document.getElementById("mensajeruc").hidden = true;
                } else {
                    const m = document.getElementById("mensajeruc").hidden = false;
                }
            });
            document.querySelector("input[name='phone_number']").addEventListener("keyup", function() {
                if (this.value = this.value.replace(/[^0-9]/g, "")) {
                    const m = document.getElementById("mensajephone").hidden = true;
                } else {
                    const m = document.getElementById("mensajephone").hidden = false;
                }
            });
        });
    </script>
@endpush

<!-- Error handling script -->
@include('includes.form.error')
