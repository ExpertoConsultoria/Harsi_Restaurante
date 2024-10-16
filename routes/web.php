<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\ComandaHomeController;
use App\Http\Controllers\ErrorsExceptions;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\GuiaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\MeseroController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PayMethodController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoriaProductoController;
use App\Http\Controllers\Turno;
use App\Http\Controllers\UserChartController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Login Form
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/inicio');
    }
    else {
        return redirect('/login');
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Error View
    Route::get('/error', function () {
        return view('error');
    });

    //Panel de Configuración
    Route::resource('Setting', SettingController::class);
    Route::get('/Setting', [SettingController::class, 'index'])->name('Setting');
    Route::get('/Setting/grafica', [SettingController::class, 'grafica']);


    //Home

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('home', [HomeController::class, 'editMesa']);

    Route::post('/datosHome', [HomeController::class, 'datos']);
    Route::post('/estadoHome', [HomeController::class, 'update']);
    Route::post('/cerrarMesa', [HomeController::class, 'cerrar']);
    Route::get('/ticket', [OrdenController::class, 'mostrar']);
    Route::get('/productos/{id_categoria}', [HomeController::class, 'productos']);
    Route::get('/precio/{id_producto}', [HomeController::class, 'precio']);

    Route::get('/obtenerComanda/{mesa}', [ComandaHomeController::class, 'obtener']);

    Route::post('/guardarComanda', [ComandaHomeController::class, 'guardar']);
    Route::post('/eliminarFila', [ComandaHomeController::class, 'eliminar']);
    Route::post('/guardarComandaExtra', [ComandaHomeController::class, 'guardarextra']);
    Route::post('/ordenCancelada', [HomeController::class, 'ordenCancelada']);
    Route::post('/guardarComentario', [ComandaHomeController::class, 'guardarComentario']);
    Route::post('/updateFoodStatus', [ComandaHomeController::class, 'updateFoodStatus']);

    //Usuarios
    Route::resource('usuarios', UserController::class);
    Route::post('user/updateFecha', [UserController::class, 'updateFecha'])->name('user.updateFecha');
    Route::get('/editFecha', [UserController::class, 'editFecha']);

    //Restaurante
    Route::resource('restaurante', RestauranteController::class);
    Route::post('restaurante/update', [RestauranteController::class, 'update'])->name('restaurante.update');
    Route::get('restaurante/destroy/{id}', [RestauranteController::class, 'destroy']);
    Route::get('/editDescuento', [RestauranteController::class, 'editDescuento']);
    Route::post('restaurante/updateDescuento', [RestauranteController::class, 'updateDescuento'])->name('restaurante.updateDescuento');
    Route::post('restaurante/updateSubcategoria', [RestauranteController::class, 'updateSubcategoria'])->name('restaurante.updateSubcategoria');
    Route::get('/editSubcategoria', [RestauranteController::class, 'editSubcategoria']);

    //Mesas
    Route::resource('Mesa', MesaController::class);
    Route::post('Mesa/update', [MesaController::class, 'update'])->name('Mesa.update');
    Route::get('Mesa/destroy/{id}', [MesaController::class, 'destroy']);

    //Categoria del producto del restaurant
    Route::resource('CategoriaProducto', CategoriaProductoController::class);
    Route::post('CategoriaProducto/update', [CategoriaProductoController::class, 'update'])->name('CategoriaProducto.update');
    Route::get('CategoriaProducto/destroy/{id}', [CategoriaProductoController::class, 'destroy']);

    //SubCategoria del producto del restaurant
    Route::resource('SubcategoriaProducto', SubcategoriaProductoController::class);
    Route::post('SubcategoriaProducto/update', [SubcategoriaProductoController::class, 'update'])->name('SubcategoriaProducto.update');
    Route::post('SubcategoriaProducto/store', [SubcategoriaProductoController::class, 'store']);
    Route::get('SubcategoriaProducto/destroy/{id}', [SubcategoriaProductoController::class, 'destroy']);

    //Productos Restaurant
    Route::resource('producto', ProductoController::class);
    Route::post('producto/update', [ProductoController::class, 'update'])->name('producto.update');
    Route::get('producto/destroy/{id}', [ProductoController::class, 'destroy']);
    Route::get('/subcategory/{id_categoria}', [ProductoController::class, 'subcategorias']);

    // Restaurant Guides
    Route::resource('guias', GuiaController::class);
    Route::post('guias/update', [GuiaController::class, 'update'])->name('guias.update');
    Route::get('guias/destroy/{id}', [GuiaController::class, 'destroy']);

    // Restaurant Waitress
    Route::resource('meseros', MeseroController::class);
    Route::post('meseros/update', [MeseroController::class, 'update'])->name('meseros.update');
    Route::get('meseros/destroy/{id}', [MeseroController::class, 'destroy']);

    //Metodo de pago
    Route::resource('paymethod', PayMethodController::class);
    Route::post('paymethod/update', [PayMethodController::class, 'update'])->name('paymethod.update');
    Route::get('paymethod/destroy/{id}', [PayMethodController::class, 'destroy']);

    //Comanda Home
    Route::resource('ComandaHome', ComandaHomeController::class);
    Route::post('ComandaHome/update', [ComandaHomeController::class, 'update'])->name('ComandaHome.update');
    Route::get('ComandaHome/destroy/{id}', [ComandaHomeController::class, 'destroy']);

    //Orden
    Route::resource('Ordenes', OrdenController::class);
    Route::post('Ordenes/update', [OrdenController::class, 'update'])->name('Ordenes.update');
    Route::get('Ordenes/destroy/{id}', [OrdenController::class, 'destroy']);

    //Calendario de eventos
    Route::resource('Calendar', CalendarController::class);
    Route::post('Calendar/update', [CalendarController::class, 'update'])->name('Calendar.update');
    Route::get('Calendar/destroy/{id}', [CalendarController::class, 'destroy']);

    //Graficas
    Route::get('Graficas', [UserChartController::class, 'index']);
    // Route::get('Graficas/chart', [UserChartController::class, 'chart']);
    Route::get('Graficas/menosVendido', [UserChartController::class, 'menosVendido']);
    Route::get('Graficas/orden', [UserChartController::class, 'orden']);
    Route::get('chartjs', [HomeController::class, 'chartjs']);

    //Reportes
    Route::resource('Reportes', ReportesController::class);
    Route::post('pdf/ventas', [ReportesController::class, 'listaVentas'])->name('ventas.pdf');
    Route::get('pdf/user', [ReportesController::class, 'listaUsuarios'])->name('user.pdf');
    Route::get('pdf/categoria', [ReportesController::class, 'listaCategorias'])->name('categoria.pdf');
    Route::get('pdf/producto', [ReportesController::class, 'listaProductos'])->name('producto.pdf');
    Route::get('/reporteAnual/{estado}', [ReportesController::class, 'listaVentas']);
    Route::get('/reporteDiario/{estado}/{fecha}', [ReportesController::class, 'reporteDiario']);
    Route::get('pdf/reporteMensual', [ReportesController::class, 'reporteMensual'])->name('reporteMensual.pdf');
    Route::get('/reporteMensual/{estado}/{meses}', [ReportesController::class, 'reporteMensual']);
    Route::get('/meses/{estado}', [ReportesController::class, 'obtenerMeses']);
    Route::get('/reporteEliminados/{estado}/{meses}', [ReportesController::class, 'reporteEliminados']);
    Route::get('/mesesEliminados/{estado}', [ReportesController::class, 'obtenerMesesEliminados']);
    Route::get('/reporteDiarioEliminados/{estado}', [ReportesController::class, 'reporteDiarioEliminados']);
    Route::get('/listas/{estado}', [ReportesController::class, 'lista']);

    Route::get('/reporteMesasEliminadas/{estado}/{meses}', [ReportesController::class, 'reporteMesasEliminados']);
    Route::get('/reporteMesasDiarioEliminados/{estado}', [ReportesController::class, 'reporteMesasDiarioEliminados']);
    Route::get('/reporteIncidenciasDiarias/{estado}/{tipo}/{fecha}', [ReportesController::class, 'incidenciasDiarias']);
    Route::get('/reporteIncidenciasMensuales/{estado}/{tipo}/{meses}', [ReportesController::class, 'incidenciasMensuales']);

    Route::get('/commissionsPerDay/{fecha}/{guide_id}', [ReportesController::class, 'commissionsPerDay']);

    Route::get('/horario', [Turno::class, 'index'])->name('Turno.index');
    Route::post('Turno/store', [Turno::class, 'store'])->name('Turno.store');
    Route::post('Turno/update', [Turno::class, 'update'])->name('Turno.update');
    Route::get('/editTurno/{id}', [Turno::class, 'edit']);
    Route::get('Turno/destroy/{id}', [Turno::class, 'destroy']);


    Route::get('/inicio', [HomeController::class, 'inicio']); // editar en controlador de login y HomeController
    Route::get('/comanda', [HomeController::class, 'inicio']); // editar en controlador de login y HomeController

    Route::get('/errors', [ErrorsExceptions::class, 'index']);
    Route::get('Manual', [HomeController::class, 'manual']);
});
