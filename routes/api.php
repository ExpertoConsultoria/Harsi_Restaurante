<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\UserChartController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/Proyecto/{id}/titulo', [CategoriaProductoController::class, 'byProducto']);
Route::get('/Precio/{id}/precio', [ProductoController::class, 'byPrice']);


Route::get('/producto/{id}/producto', [ProductoController::class, 'byProducto']);
Route::get('/producto/{name}/titulo', [ProductoController::class, 'byName']);
Route::get('/producto/{id}/precio', [ProductoController::class, 'byPrice']);

Route::get('/reservations/{id}', [ApiController::class, 'getReservations']);

// Real Time Data
Route::get('Graficas/chart', [UserChartController::class, 'chart']);
Route::get('/paymentMethods', [ApiController::class, 'getPaymentMethods']);
Route::get('/rooms', [ApiController::class, 'getRooms']);
Route::get('/tables', [ApiController::class, 'getTables']);
Route::get('/resumeSales', [ApiController::class, 'getResumeSales']);

Route::get('/calendar/events', [ApiController::class, 'createEvents']);



