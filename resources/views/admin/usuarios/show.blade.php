{{-- Recibimos del controlador la variable $Usuario --}}
@extends('layouts.admin'){{-- Usamos la directiva de laravel @extends indicando que usaremos la vista admin que se ecuentra en layouts/admin --}}
{{-- Usamos una directiva @section para indicar que crearemos elementos que se mostraran en el yield con nombre 'content' de la vista layouts/admin  --}}
@section('content')
<div class="d-flex justify-content-center align-items-center">
  <div class="col-md-6">
    <div class="text-center mb-4">
      <h1>Información del Usuario</h1>
      <hr>
    </div>
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="form-group">
          <label for="name">Nombre del Usuario</label>
          <p>{{ $usuario->name }}</p> 
        </div>
        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <p>{{ $usuario->email }}</p>
        </div>
        <div class="form-group">
          <label for="created_at">Fecha de Creación</label>
          <p>{{ $usuario->created_at }}</p>
        </div>
        <div class="form-group">
          <label for="update_at">Fecha de Actualización</label>
          @if ($usuario->updated_at == $usuario->created_at) 
            <p>No se han realizado cambios</p>
          @else
            <p>{{ $usuario->updated_at }}</p>
          @endif
        </div>
        <hr>
        <div class="text-center">
          <a href="{{ url('/admin/usuarios') }}" class="btn btn-danger">Volver</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection {{-- Finalizamos la seccion indicando que este sera el contenido enviado al yield --}}
