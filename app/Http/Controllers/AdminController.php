<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){

        //Almacenamos todos los usuarios en la variable usuarios del modelo User, por medio de su 'consulta' all()
        $usuarios = User::all(); //Devuelve una colleccion con todos los usuarios existentes en la base de datos

        return view('admin.index',compact('usuarios')); //Retornamos la vista que se encuentre en la carpeta admin/index y usamos compact para convertir la collecion en una array asosiativo y se lo enviamos a la vista
    }
}
