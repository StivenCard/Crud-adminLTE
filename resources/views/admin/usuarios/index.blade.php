{{-- Recibimos la variable $usuarios ya que lo enviamos por medio del controllador en el compact --}}
@extends('layouts.admin') {{-- Usamos la directiva de laravel @extends indicando que usaremos la vista admin que se ecuentra en layouts/admin --}}
{{-- Usamos una directiva @section para indicar que crearemos elementos que se mostraran en el yield con nombre 'content' de la vista layouts/admin  --}}
@section('content')
<div class="row mb-3">
  <div class="col-12">
    <h1>Listado de Usuarios</h1>
    <hr>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex justify-content-end">
        <a href="{{ url('/admin/usuarios/create') }}" class="btn btn-primary">
          <i class="bi bi-person-add"></i> Crear Usuario
        </a>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover table-bordered mb-0 w-100">
            <thead class="thead-light">
              <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 30%;">Nombre</th>
                <th style="width: 35%;">Correo Electrónico</th>
                <th style="width: 30%;">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($usuarios as $usuario) {{-- usamos la directiva @foreach para recorrer la variable envida --}}
              <tr>
                <td>{{ $loop->iteration }}</td> {{-- Usamos loop una variable de laravel para el foreach para mostrar numero de iteraciones  --}}
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                  <a href="{{ route('usuario.show', $usuario->id) }}" class="btn btn-info btn-sm me-2">{{-- Usamos en el href el route el cual recibe como parametros el nombre de la ruta a la que quiere dirigir y un parametro opcional en este caso el id del usuario --}}
                    <i class="bi bi-info-circle"></i> Info
                  </a>

                  <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-success btn-sm me-2"> {{-- Usamos en el href el route el cual recibe como parametros el nombre de la ruta a la que quiere dirigir y un parametro opcional en este caso el id del usuario --}}
                    <i class="bi bi-pencil"></i> Editar
                  </a>

                  <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="d-inline" data-confirm="delete"> {{-- Usamos en el href el route el cual recibe como parametros el nombre de la ruta a la que quiere dirigir y un parametro opcional en este caso el id del usuario --}}
                    @csrf {{-- Directiva encargada de agregar una capa de seguridad, crea un token --}}
                    @method('DELETE') {{-- Especificamos el metodo que se va a realizar, ya que el form el metodo solo detecta get o post --}}
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i> Eliminar
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach {{-- Finalizamos el ciclo del foreach --}}
            </tbody>
          </table>
          {{-- paginacion, toca mover el UserController --}}
          {{-- <div class="mt-3">
            {{ $usuarios->links() }}
          </div> --}}
        </div> 
      </div> 
    </div> 
  </div> 
</div> 
{{-- 
Aca hacemos uso de un script proporcionado por Sweetalert encargado de mostrar la confirmacion para eliminar un usuario --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const deleteForms = document.querySelectorAll('form[data-confirm="delete"]');

    deleteForms.forEach(function (form) {
      form.addEventListener("submit", function (e) {
        e.preventDefault(); // Evita el envío automático

        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
          },
          buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
          title: "¿Estás seguro?",
          text: "¡Esta acción no se puede deshacer!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Sí, eliminar",
          cancelButtonText: "Cancelar",
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit(); // Solo se envía si el usuario confirma
          }
        });
      });
    });
  });
</script>

@endsection {{-- Finalizamos la seccion indicando que este sera el contenido enviado al yield --}}