<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use stdClass;

use App\Models\PayMethod;
use App\Models\Calendar;
use App\Models\Producto;
use App\Models\Mesa;

use App\Models\User;
use App\Models\Orden;
use App\Models\ComandaTemporal;
use App\Models\OrdenCancelado;

class ApiController extends Controller
{
    public function getPaymentMethods() {
        return PayMethod::all();
    }

    public function getTables(){
        return Mesa::all();
    }

    public function getReservations($id) {
        return Calendar::select('mesas')->where('id',$id)->first();
    }

    public function getResumeSales() {
        $today = Carbon::today();
        $now = Carbon::now();

        // Conteo de usuarios
        $user = User::whereIn('role', ['cajero', 'administrador', 'jefe_meseros', 'jefe_cocina'])->count();

        // Ordenes
        $orden = Orden::whereMonth('fecha', $today)->whereYear('fecha', $today)->count();
        $ordenD = Orden::whereDate('fecha', $today)->count();

        // Ventas
        $venta = Orden::whereMonth('fecha', $now)->whereYear('fecha', $today)->sum('total');
        $ventaD = Orden::whereDate('fecha', $today)->sum('total');
        $ventaPl = Orden::whereMonth('fecha', $now)->whereYear('fecha', $today)->where('mesa', 'Para llevar')->sum('total');
        $ventaDPl = Orden::whereDate('fecha', $today)->where('mesa', 'Para llevar')->sum('total');

        // Cancelaciones y eliminaciones
        $cancelado = ComandaTemporal::whereMonth('fecha', $now)->where('status', 'Cancelado')->count();
        $canceladoD = ComandaTemporal::whereDate('fecha', $now)->where('status', 'Cancelado')->count();
        $eliminado = ComandaTemporal::whereMonth('fecha', $now)->whereYear('fecha', $today)->where('status', 'Eliminado')->count();
        $eliminadoD = ComandaTemporal::whereDate('fecha', $now)->where('status', 'Eliminado')->count();

        // Eventos
        $event = Calendar::whereMonth('updated_at', $now)->whereYear('updated_at', $today)->count();
        $eventD = Calendar::whereDate('updated_at', $today)->count();

        // Otros datos
        $producto = Producto::count();
        $mesa = Mesa::count();
        $mesasC = OrdenCancelado::whereMonth('fecha', $now)->whereYear('fecha', $today)->count();
        $mesasCD = OrdenCancelado::whereDate('fecha', $now)->count();

        // Ventas por apps
        $ventaApps = Orden::whereMonth('fecha', $today)
            ->whereYear('fecha', $today)
            ->whereIn('mesa', ['Uber', 'Rappi', 'Diddi'])
            ->sum('total');

        $ventaAppsD = Orden::whereDate('fecha', $today)
            ->whereIn('mesa', ['Uber', 'Rappi', 'Diddi'])
            ->sum('total');

        // Descuentos y propinas
        $descuento = Orden::whereDate('fecha', $today)->sum('descuento_pesos');
        $descuentoD = $descuento;  // Redundante, pero mantenido según requisitos
        $propina = Orden::whereMonth('fecha', $today)->whereYear('fecha', $today)->sum('propina');
        $propinaD = Orden::whereDate('fecha', $today)->sum('propina');

        // Respuesta
        $response = [
            'user' => $user,
            'mesa' => $mesa,
            'orden' => $orden,
            'venta' => $venta,
            'event' => $event,
            'eventD' => $eventD,
            'producto' => $producto,
            'ventaD' => $ventaD,
            'ordenD' => $ordenD,
            'ventaPl' => $ventaPl,
            'ventaDPl' => $ventaDPl,
            'cancelado' => $cancelado,
            'canceladoD' => $canceladoD,
            'eliminado' => $eliminado,
            'eliminadoD' => $eliminadoD,
            'mesasC' => $mesasC,
            'mesasCD' => $mesasCD,
            'ventaApps' => $ventaApps,
            'ventaAppsD' => $ventaAppsD,
            'descuento' => $descuento,
            'descuentoD' => $descuentoD,
            'propina' => $propina,
            'propinaD' => $propinaD,
        ];

        return $response;
    }


    public function createEvents() {
        $calendar = Calendar::all();

        $response = [];

        foreach ($calendar as $event){
            $data = new stdClass;
                $data->id = $event->id;
                $data->title = $event->titulo;
                $data->start = $event->fecha;
                $data->end = $event->fecha;
                $data->borderColor = $event->color;
                $data->backgroundColor = $event->color. "4d";
                $data->textColor = '#000000';
                $data->classNames = [ 'Detalles del Evento', $event->personas, $event->detalles];

            array_push($response, $data);
        }

        return $response;

    }


}
