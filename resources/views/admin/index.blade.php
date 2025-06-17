{{-- Recibimos la variable $usuarios ya que lo enviamos por medio del controllador en el compact --}}
@extends('layouts.admin'){{-- Usamos la directiva de laravel @extends indicando que usaremos la vista admin que se ecuentra en layouts/admin --}}
{{-- Usamos una directiva @section para indicar que crearemos elementos que se mostraran en el yield con nombre 'content' de la vista layouts/admin  --}}
@section('content')
  <div class="row">
    <h1>Bienvenido al sistema</h1>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ count($usuarios) }}</h3> {{-- usamos la funcion count que nos devuelve el total de usuarios --}}
          <p>Usuarios Registrados</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-plus"></i>
        </div>
        <a href="{{ route('usuarios.index') }}" class="small-box-footer">
          Mas informacion <i class="fas fa-arrow-circle-right"></i> {{-- Usamos en el href el route el cual recibe como parametros el nombre de la ruta a la que quiere dirigir --}}
        </a>
      </div>
    </div>
  </div>
@endsection
