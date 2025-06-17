<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;

/* Route::get('/', function () {
    return view('admin.usuarios.index');
}); */

//Rutas autorizadas creadas por el packete de bootstrrap
Auth::routes();

/* Route::get('/home', [HomeController::class, 'index'])->name('home'); */


//Rutas del proyecto
//Las Rutas tienen un tipo de comunicacion HTTP que puede ser get,post,put,patch,delete. Se define la ruta en el primer parametro y tambien si requiere parametro con las {}, en el segundo parametro indica que mostraremos la informacion atra vez delos controladores e indicando el metodo que usaremos del controlador, se le asigna un nombre a la ruta que es usado para cuando usamos route() para navegar a esa ruta, e implementacion del middleware para la autorizacion
Route::get('/',[AdminController::class, 'index'])->name('admin.index')->middleware('auth'); 
Route::get('/admin/usuarios',[UsuarioController::class,'index'])->name('usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create',[UsuarioController::class,'create'])->name('usuario.create')->middleware('auth'); 
Route::post('/admin/usuarios',[UsuarioController::class,'store'])->name('usuario.store')->middleware('auth'); 
Route::get('/admin/usuarios/{id}',[UsuarioController::class,'show'])->name('usuario.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit',[UsuarioController::class,'edit'])->name('usuario.edit')->middleware('auth'); 
Route::put('/admin/usuarios/{id}',[UsuarioController::class,'update'])->name('usuario.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}',[UsuarioController::class,'destroy'])->name('usuario.destroy')->middleware('auth');

