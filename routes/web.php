<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubcategoriaProductoController;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\PrecioProductoController;
use App\Http\Controllers\DetalleOrdenController;
use App\Http\Controllers\ComandaHomeController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\ComandaEspController;
use App\Http\Controllers\UserChartController;
use App\Http\Controllers\PayMethodController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ComandaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ErrorsExceptions;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Turno;


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
    return view('welcome');
});

// Error View
Route::get('/error', function () {
    return view('error');
});

//Panel de Configuración
Route::resource('Setting', SettingController::class);
Route::get('/Setting', [SettingController::class, 'index'])->name('Setting');
Route::get('/Setting/grafica', [SettingController::class, 'grafica']);

//Rutas
Auth::routes();

//Home

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('home', [HomeController::class, 'editMesa']);

Route::resource('panel', PanelController::class);
Route::get('/paneledit/{id}', [PedidoController::class, 'create']);
Route::post('/datosHome', [HomeController::class, 'datos']);
Route::post('/estadoHome', [HomeController::class, 'update']);
Route::post('/cerrarMesa', [HomeController::class, 'cerrar']);
Route::get('/ticket', [OrdenController::class, 'mostrar']);
Route::post('/enviarTicket', [OrdenController::class, 'enviarTicket']);
Route::post('/enviarTicketOrden', [OrdenController::class, 'ticketPdfshow']);
Route::get('/productos/{id_categoria}', [HomeController::class, 'productos']);
Route::get('/precio/{id_producto}', [HomeController::class, 'precio']);

Route::get('/obtenerComanda/{mesa}', [ComandaHomeController::class, 'obtener']);

Route::post('/guardarComanda', [ComandaHomeController::class, 'guardar']);
Route::post('/eliminarFila', [ComandaHomeController::class, 'eliminar']);
Route::post('/guardarComandaExtra', [ComandaHomeController::class, 'guardarextra']);
Route::post('/ordenCancelada', [HomeController::class, 'ordenCancelada']);
Route::post('/guardarComentario', [ComandaHomeController::class, 'guardarComentario']);

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
Route::post('restaurante/updateReducir', [RestauranteController::class, 'updateReducir'])->name('restaurante.updateReducir');
Route::get('/editReducirElementos', [RestauranteController::class, 'editReducir']);
Route::post('restaurante/updateHotel', [RestauranteController::class, 'updateHotel'])->name('restaurante.updateHotel');
Route::get('/editIntegrarHotel', [RestauranteController::class, 'editHotel']);

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

//Precio Producto
Route::resource('PrecioProducto', ProductoController::class);
Route::post('PrecioProducto/update', [ProductoController::class, 'update'])->name('PrecioProducto.update');
Route::get('PrecioProducto/destroy/{id}', [ProductoController::class, 'destroy']);

//Metodo de pago
Route::resource('paymethod', PayMethodController::class);
Route::post('paymethod/update', [PayMethodController::class, 'update'])->name('paymethod.update');
Route::get('paymethod/destroy/{id}', [PayMethodController::class, 'destroy']);

//Pedido
Route::resource('Pedido', PedidoController::class);
Route::post('Pedido/update', [PedidoController::class, 'update'])->name('Pedido.update');
Route::get('Pedido/destroy/{id}', [PedidoController::class, 'destroy']);

//Comanda
Route::resource('Comanda', ComandaController::class);
Route::post('Comanda/update', [ComandaController::class, 'update'])->name('Comanda.update');
Route::get('Comanda/destroy/{id}', [ComandaController::class, 'destroy']);

//Comanda especial
Route::resource('ComandaEsp', ComandaEspController::class);
Route::post('ComandaEsp/update', [ComandaEspController::class, 'update'])->name('ComandaEsp.update');
Route::get('ComandaEsp/destroy/{id}', [ComandaEspController::class, 'destroy']);

//Comanda Home
Route::resource('ComandaHome', ComandaHomeController::class);
Route::post('ComandaHome/guardar', [ComandaHomeController::class, 'guardarConsumo'])->name('ComandaHome.guardarConsumo');
Route::post('ComandaHome/update', [ComandaHomeController::class, 'update'])->name('ComandaHome.update');
Route::get('ComandaHome/destroy/{id}', [ComandaHomeController::class, 'destroy']);

//Orden
Route::resource('Ordenes', OrdenController::class);
Route::post('Ordenes/update', [OrdenController::class, 'update'])->name('Ordenes.update');
Route::get('Ordenes/destroy/{id}', [OrdenController::class, 'destroy']);
Route::get('/ticketPdf', [OrdenController::class, 'ticketPdf'])->name('ticketPdf');
Route::get('pdf', [OrdenController::class, 'invoice']);

//DetalleOrden
Route::resource('DetalleOrden', DetalleOrdenController::class);
Route::post('DetalleOrden/update', [DetalleOrdenController::class, 'update'])->name('DetalleOrden.update');
Route::get('DetalleOrden/destroy/{id}', [DetalleOrdenController::class, 'destroy']);

//Estado de Orden
Route::resource('Estado', EstadoController::class);
Route::post('Estado/update', [EstadoController::class, 'update'])->name('Estado.update');
Route::get('Estado/destroy/{id}', [EstadoController::class, 'destroy']);

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
Route::get('pdf/diario', [ReportesController::class, 'listaVentasDiarias'])->name('diario.pdf');
Route::get('/reporteDiario/{estado}/{fecha}', [ReportesController::class, 'reporteDiario']);
Route::get('/ventaDiarioPdf/{estado}/{fecha}', [ReportesController::class, 'reporteDiarioPdf']);
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

Route::get('/horario', [Turno::class, 'index'])->name('Turno.index');
Route::post('Turno/store', [Turno::class, 'store'])->name('Turno.store');
Route::post('Turno/update', [Turno::class, 'update'])->name('Turno.update');
Route::get('/editTurno/{id}', [Turno::class, 'edit']);
Route::get('Turno/destroy/{id}', [Turno::class, 'destroy']);


Route::get('/inicio', [HomeController::class, 'inicio']); // editar en controlador de login y HomeController
Route::get('/comanda', [HomeController::class, 'inicio']); // editar en controlador de login y HomeController

Route::get('/errors', [ErrorsExceptions::class, 'index']);
Route::get('Manual', [HomeController::class, 'manual']);
