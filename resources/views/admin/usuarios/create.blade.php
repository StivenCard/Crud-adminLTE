@extends('layouts.admin') {{-- Usamos la directiva de laravel @extends indicando que usaremos la vista admin que se ecuentra en layouts/admin --}}
{{-- Usamos una directiva @section para indicar que crearemos elementos que se mostraran en el yield con nombre 'content' de la vista layouts/admin  --}}
@section('content')
<div class="d-flex justify-content-center align-items-center">
  <div class="col-md-6">
    <div class="text-center mb-2">
      <h1>Nuevo Usuario</h1>
    </div>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h4>Diligencie los datos</h4>
      </div>
      <div class="card-body">
        <form action="{{ url('/admin/usuarios') }}" method="post">
          @csrf {{-- Directiva encargada de agregar una capa de seguridad, crea un token --}}
          {{-- Aca no especificamos con la directiva method ya que se encuentra en los atributos del formulario --}}
          <div class="form-group">
            <label for="name">Nombre del Usuario</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
            @error('name') {{-- usamos la directiva error para mostrar en pantalla el error que proviene de la verificacion el parametro al que se evalua para mostrar el error es 'name' --}}
              <small style="color: red">{{ $message }}</small> {{-- message es una variable que ya esta por defecto en la vista gracias a laravel --}}
            @enderror {{-- finalizamos el error --}}
          </div>

          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
            @error('email') {{-- usamos la directiva error para mostrar en pantalla el error que proviene de la verificacion el parametro al que se evalua para mostrar el error es 'email' --}}
              <small style="color: red">{{ $message }}</small> {{-- message es una variable que ya esta por defecto en la vista gracias a laravel --}}
            @enderror {{-- finalizamos el error --}}
          </div>

          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') {{-- usamos la directiva error para mostrar en pantalla el error que proviene de la verificacion el parametro al que se evalua para mostrar el error es 'password' --}}
              <small style="color: red">{{ $message }}</small> {{-- message es una variable que ya esta por defecto en la vista gracias a laravel --}}
            @enderror {{-- finalizamos el error --}}
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" required class="form-control">
            @error('password_confirmation') {{-- usamos la directiva error para mostrar en pantalla el error que proviene de la verificacion el parametro al que se evalua para mostrar el error es 'password_confirmation' --}}
              <small style="color: red">{{ $message }}</small> {{-- message es una variable que ya esta por defecto en la vista gracias a laravel --}}
            @enderror {{-- finalizamos el error --}}
          </div>

          <hr>
          <div class="form-group text-center">
            <a href="{{ url('/admin/usuarios') }}" class="btn btn-danger">Cancelar</a> {{-- url en el href es otra manera de navegar entre las vistas pero este usa la url especificada para la vista, no su nombre asiganado --}}
            <button type="submit" class="btn btn-success"><i class="bi bi-floppy"></i> Crear Usuario</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection {{-- Finalizamos la seccion indicando que este sera el contenido enviado al yield --}}
