<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\AdministradoresController;
use App\Http\Controllers\PaqueteriaController;
use App\Http\Controllers\UsuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('Principal', function () {
    return view('Principal');
});
// Route::get('Productos', function () {
//     return view('Productos');
// });

Route::get('Productos',[ProductosController::class,'Productos']);
Route::POST('GuardarProductos',[ProductosController::class,'GuardarProductos'])->name('GuardarProductos');
Route::get('ReporteProductos',[ProductosController::class,'ReporteProductos'])->name('ReporteProductos');
Route::get('DesactivarProductos/{id}',[ProductosController::class,'DesactivarProductos'])->name('DesactivarProductos');
Route::get('EliminarProductos/{id}',[ProductosController::class,'EliminarProductos'])->name('EliminarProductos');
Route::get('RestaurarProductos/{id}',[ProductosController::class,'RestaurarProductos'])->name('RestaurarProductos');
Route::POST('EditarProductos/{id}',[ProductosController::class,'EditarProductos'])->name('EditarProductos');
Route::get('ModificarProductos/{id}/edit',[ProductosController::class,'ModificarProductos'])->name('ModificarProductos');


//--------MARCAS
Route::get('Marcas',[MarcasController::class,'Marcas']);
Route::POST('GuardarMarcas',[MarcasController::class,'GuardarMarcas'])->name('GuardarMarcas');
Route::get('ReporteMarcas',[MarcasController::class,'ReporteMarcas'])->name('ReporteMarcas');
Route::get('DesactivarMarca/{id}',[MarcasController::class,'DesactivarMarca'])->name('DesactivarMarca');
Route::get('EliminarMarca/{id}',[MarcasController::class,'EliminarMarca'])->name('EliminarMarca');
Route::get('RestaurarMarca/{id}',[MarcasController::class,'RestaurarMarca'])->name('RestaurarMarca');
Route::POST('EditarMarca/{id}',[MarcasController::class,'EditarMarca'])->name('EditarMarca');
Route::get('ModificarMarca/{id}/edit',[MarcasController::class,'ModificarMarca'])->name('ModificarMarca');


//--------PROVEEDORES

Route::get('ReporteProveedores',[ProveedoresController::class,'ReporteProveedores'])->name('ReporteProveedores');
Route::get('Proveedores',[ProveedoresController::class,'Proveedores']);
Route::POST('GuardarProveedores',[ProveedoresController::class,'GuardarProveedores'])->name('GuardarProveedores');
Route::POST('EditarProveedores/{id}',[ProveedoresController::class,'EditarProveedores'])->name('EditarProveedores');
Route::get('ModificarProveedores/{id}/edit',[ProveedoresController::class,'ModificarProveedores'])->name('ModificarProveedores');
Route::get('DesactivarProveedores/{id}',[ProveedoresController::class,'DesactivarProveedores'])->name('DesactivarProveedores');
Route::get('EliminarProveedores/{id}',[ProveedoresController::class,'EliminarProveedores'])->name('EliminarProveedores');
Route::get('RestaurarProveedores/{id}',[ProveedoresController::class,'RestaurarProveedores'])->name('RestaurarProveedores');

//----------ADMINISTRADORES
route::get('reporteadmin',[AdministradoresController::class,'reporteadmin'])->name('reporteadmin');

route::get('altaadmin',[AdministradoresController::class,'altaadmin'])->name('altaadmin');
route::POST('guardaradmin',[AdministradoresController::class,'guardaradmin'])->name('guardaradmin');

route::get('desactivaradmin/{ClaveAdministrador}',[AdministradoresController::class,'desactivaradmin'])->name('desactivaradmin');
route::get('activaradmin/{ClaveAdministrador}',[AdministradoresController::class,'activaradmin'])->name('activaradmin');
route::get('borraradmin/{ClaveAdministrador}',[AdministradoresController::class,'borraradmin'])->name('borraradmin');

route::get('modificaradmin/{ClaveAdministrador}',[AdministradoresController::class,'modificaradmin'])->name('modificaradmin');
route::post('cambiaradmin',[AdministradoresController::class,'cambiaradmin'])->name('cambiaradmin');


route::get('eloquent',[AdministradoresController::class,'eloquent'])->name('eloquent');

//---------------PAQUETER??A

route::get('altapaqueteria',[PaqueteriaController::class,'altapaqueteria'])->name('altapaqueteria');
route::POST('guardarpaqueteria',[PaqueteriaController::class,'guardarpaqueteria'])->name('guardarpaqueteria');

route::get('reportepaqueteria',[PaqueteriaController::class,'reportepaqueteria'])->name('reportepaqueteria');


route::get('desactivarpaqueteria/{Id_paqueteria}',[PaqueteriaController::class,'desactivarpaqueteria'])->name('desactivarpaqueteria');
route::get('activarpaqueteria/{Id_paqueteria}',[PaqueteriaController::class,'activarpaqueteria'])->name('activarpaqueteria');
route::get('borrarpaqueteria/{Id_paqueteria}',[PaqueteriaController::class,'borrarpaqueteria'])->name('borrarpaqueteria');

route::get('modificarpaqueteria/{Id_paqueteria}',[PaqueteriaController::class,'modificarpaqueteria'])->name('modificarpaqueteria');
route::post('cambiarpaqueteria',[PaqueteriaController::class,'cambiarpaqueteria'])->name('cambiarpaqueteria');

//--------------USUARIOS
Route::get('Usuarios', [UsuariosController::class, 'Usuarios'])->name ('Usuarios');

Route::post('Mensaje', [UsuariosController::class, 'Mensaje'])->name ('Mensaje');

Route::post('guardarusuario', [UsuariosController::class, 'guardarusuario'])->name ('guardarusuario');

Route::get('reporteusuarios', [UsuariosController::class, 'reporteusuarios'])->name ('reporteusuarios');

//este recibe un parametro que es la id del empleado que se va a desactivar
Route::get('desactivausuario/{id_usuario}',[UsuariosController::class, 'desactivausuario'])
->name('desactivausuario');

//Este recibe un parametro que es la id del empleado para que se active el empleado
Route::get('activarusuario/{id_usuario}',[UsuariosController::class, 'activarusuario'])
->name('activarusuario');

//Este recibe un parametro que es la id del empleado para que se borre el empleado
Route::get('borrausuario/{id_usuario}',[UsuariosController::class, 'borrausuario'])
->name('borrausuario');

//Este recibe un parametro que es la id del empleado para que se pueda modificar el empleado
Route::get('modificausuario/{id_usuario}',[UsuariosController::class, 'modificausuario'])
->name('modificausuario');

Route::post('guardacambios', [UsuariosController::class, 'guardacambios'])->name ('guardacambios');
