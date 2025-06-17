<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    //
    public function index(){

        //Almacenamos todos los usuarios en la variable usuarios del modelo User, por medio de su 'consulta' all()
        $usuarios = User::all();
        return view('admin.usuarios.index',compact('usuarios')); //Retornamos la vista que se encuentra en la carpeta admin/usuario/index y usamos compact para convertir la collecion en una array asosiativo y se lo enviamos a la vista

        //Otra manera de enviar los datos a la vista ['usuarios'=> $usuarios] 
    }

    public function create(){

        //Retornamos la vista que se encuentra en la carpeta admin/usuarios/create y no le enviamos datos a la vista
        return view('admin.usuarios.create');
    }

    public function store(Request $request){
        
        //Validamos la data que es enviada por medio del formulario
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        //Creamos un nuevo usuario
        $usuario = new User();
        //Asiganmos al nuevo usuario en sus respectivos parametros, los respectivos valores que vienen en el formulario (request)
        $usuario->name = $request->name; 
        $usuario->email = $request->email;
        // $usuario->password = $request->password; otra nanera de asiganar la contrasena
        $usuario->password = Hash::make($request['password']); //Asignamos la contrasena pero esta la enviaremos hasheada (Para seguridad)

        $usuario->save(); //Indicamos que este usuario se guardara en la BD

        //Una vez guardado redireccionamos a la vista con nombre: usuarios.index que esta en admin/usuarios, y hacemos una sesion 
        return redirect()->route('usuarios.index')
        ->with('mensaje', 'Usuario Creado correctamente.')
        ->with('icono','success');
    }

    public function show($id){
        /* Recibimos el parametro id, este se recibe por medio de la ruta, llamamos al modelo y hacemos una busqueda por id, usamos el findOrFail para evitar el error de poner un ide inexistente  */
        $usuario = User::findOrFail($id);

        /* Retornamos la vista que se encuentra en la carpeta admin/usuario/show y usamos compact para convertir el elemento en una array asosiativo y se lo enviamos a la vista */
        return view('admin.usuarios.show',compact('usuario'));
    }

    public function edit($id){
        /* Recibimos el parametro id, este se recibe por medio de la ruta, llamamos al modelo y hacemos una busqueda por id, usamos el findOrFail para evitar el error de poner un ide inexistente  */
        $usuario = User::findOrFail($id);
        /* Retornamos la vista que se encuentra en la carpeta admin/usuario/edit y usamos compact para convertir el elemento en una array asosiativo y se lo enviamos a la vista */
        return view('admin.usuarios.edit',compact('usuario'));
    }

    public function update(Request $request, $id){
        /*$request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|confirmed'
        ]);

        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password; 
        $usuario->password = Hash::make($request['password']);
        $usuario->save();
        
        return redirect()->route('usuarios.index'); */

        //Validamos la data que es enviada por medio del formulario

        //Otra manera mas Actualizada
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|confirmed'
        ]);

        /* Recibimos el parametro id, este se recibe por medio de la ruta, llamamos al modelo y hacemos una busqueda por id, usamos el findOrFail para evitar el error de poner un ide inexistente  */
        $usuario = User::findOrFail($id);

        /* Utilizamos el metodo update para indicar que campos queremos actualizar y le asignamos lo recibido del formulario y guarda automaticamente*/
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Una vez guardado redireccionamos a la vista con nombre: usuarios.index que esta en admin/usuarios, y hacemos una sesion
        return redirect()->route('usuarios.index')
        ->with('mensaje', 'Usuario actualizado correctamente.')
        ->with('icono','success');
    }

    public function destroy($id){
        /* Recibimos el parametro id, este se recibe por medio de la ruta, llamamos al modelo y hacemos una busqueda por id, usamos el destroy para eliminar */
        User::destroy($id);

        //Una vez eliminado redireccionamos a la vista con nombre: usuarios.index que esta en admin/usuarios, y hacemos una sesion
        return redirect()->route('usuarios.index')
        ->with('mensaje', 'Usuario Eliminado correctamente.')
        ->with('icono','success');
    }
}

//Las sesiones son aquellas que nos permiten en las vistas mostrar las alertas del sweetalert