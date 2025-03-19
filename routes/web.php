<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios');
Route::post('/usuario/agregar', [App\Http\Controllers\UserController::class, 'store'])->name('agregar.usuario');
Route::post('/usuario/actualizar', [App\Http\Controllers\UserController::class, 'update'])->name('actualizar.usuario');
Route::post('/usuario/borrar', [App\Http\Controllers\UserController::class, 'destroy'])->name('borrar.usuario');

Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
Route::post('/role/agregar', [App\Http\Controllers\RoleController::class, 'store'])->name('agregar.rol');
Route::post('/role/actualizar', [App\Http\Controllers\RoleController::class, 'update'])->name('actualizar.rol');
Route::post('/role/borrar', [App\Http\Controllers\RoleController::class, 'destroy'])->name('borrar.rol');
Route::post('/role/permisos', [App\Http\Controllers\RoleController::class, 'permisos'])->name('permisos.rol');

Route::get('/permisos', [App\Http\Controllers\PermissionController::class, 'index'])->name('permisos');
Route::post('/permiso/agregar', [App\Http\Controllers\PermissionController::class, 'store'])->name('agregar.permiso');
Route::post('/permiso/actualizar', [App\Http\Controllers\PermissionController::class, 'update'])->name('actualizar.permiso');
Route::post('/permiso/borrar', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('borrar.permiso');

Route::get('/materiales', [App\Http\Controllers\MaterialController::class, 'index'])->name('materiales');
Route::post('/material/agregar', [App\Http\Controllers\MaterialController::class, 'store'])->name('agregar.material');
Route::post('/material/actualizar', [App\Http\Controllers\MaterialController::class, 'update'])->name('actualizar.material');
Route::post('/material/borrar', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('borrar.material');

Route::get('/suelas', [App\Http\Controllers\SuelaController::class, 'index'])->name('suelas');
Route::post('/suela/agregar', [App\Http\Controllers\SuelaController::class, 'store'])->name('agregar.suela');
Route::post('/suela/actualizar', [App\Http\Controllers\SuelaController::class, 'update'])->name('actualizar.suela');
Route::post('/suela/borrar', [App\Http\Controllers\SuelaController::class, 'destroy'])->name('borrar.suela');
Route::get('/suela/desarrollo/{id}', [App\Http\Controllers\SuelaHasMaterialesController::class, 'index'])->name('desarrollo.suela');
Route::post('/suela/desarrollo/agregar', [App\Http\Controllers\SuelaHasMaterialesController::class, 'store'])->name('agregar.desarrollo.suela');
Route::post('/suela/desarrollo/actualizar', [App\Http\Controllers\SuelaHasMaterialesController::class, 'update'])->name('actualizar.desarrollo.suela');
Route::post('/suela/desarrollo/borrar', [App\Http\Controllers\SuelaHasMaterialesController::class, 'destroy'])->name('borrar.desarrollo.suela');

Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes');
Route::post('/cliente/agregar', [App\Http\Controllers\ClienteController::class, 'store'])->name('agregar.cliente');
Route::post('/cliente/actualizar', [App\Http\Controllers\ClienteController::class, 'update'])->name('actualizar.cliente');
Route::post('/cliente/borrar', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('borrar.cliente');