@extends('layouts.panel')
@section('title', 'Mostar visitas')
@section('content')
  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
      <span class="font-weight-bold">{{ session('status') }}</strong>
        <button type="button my-auto" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="pt-1 mt-4 pt-md-0 mt-md-1">&times;</span>
        </button>
    </div>
  @endif

  <div class="card shadow">
    <div class="card-header border-1">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="mb-0">Visitantes</h2>
        </div>
        <div class="col text-right">
          <a href="{{ route('visitors.create') }}" class="btn btn-sm btn-primary">Nuevo visitante</a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Entidad</th>
            <th scope="col">DNI</th>
            <th scope="col">Número de celular</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($visitors as $visitor)
            <tr>
              <th scope="row">{{ $visitor->name }}</th>
              <td>{{ $visitor->email }}</td>
              <td>{{ $visitor->entity }}</td>
              <td>{{ $visitor->dni }}</td>
              <td>{{ $visitor->phone_number }}</td>
              <td>
                <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-sm btn-primary">Editar</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                  data-target="#deleteModal{{ $visitor->id }}">Eliminar</button>
              </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="deleteModal{{ $visitor->id }}" tabindex="-1" role="dialog"
              aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="deleteModalLabel">
                      Confirmar acción
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body py-0 my-0">
                    ¿Está seguro(a) que desea <span class="text-dark">eliminar</span> la visita "{{ $visitor->name }}"?
                  </div>
                  <div class="modal-footer pt-3">
                    <form action="{{ route('visitors.destroy', $visitor) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-danger">Confirmar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </tbody>
      </table>


      <hr class="mt-1 mb-3">
      <div class="card-body d-sm-flex justify-content-center py-0">
        {{ $visitors->links() }}
      </div>
    </div>
  </div>
@endsection
