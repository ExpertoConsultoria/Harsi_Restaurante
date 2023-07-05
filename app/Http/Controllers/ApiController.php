<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use stdClass;

use App\Models\PayMethod;
use App\Models\Calendar;
use App\Models\Producto;
use App\Models\Mesa;
use App\Models\Room;

use App\Models\User;
use App\Models\Orden;
use App\Models\ComandaTemporal;
use App\Models\OrdenCancelado;

class ApiController extends Controller
{
    public function getPaymentMethods(){
        return PayMethod::all();
    }

    public function getRooms(){
        return Room::select('room_number')->where('room_status', 'Ocupado')->get();
    }

    public function getTables(){
        return Mesa::all();
    }

    public function getReservations($id){
        return Calendar::select('mesas')->where('id',$id)->first();
    }

    public function getResumeSales(){
        $userg = User::where('role', 'gerente')->count();
        $userc = User::where('role', 'cajero')->count();
        $usera = User::where('role', 'administrador')->count();
        $user = $userg + $userc + $usera;
        $orden = Orden::whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->count();
        $ordenD = Orden::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->count();
        $mesa = Mesa::select('id')->count();
        $venta = Orden::whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->sum('total');
        $ventaD = Orden::where('fecha', Carbon::today())->sum('total');
        $ventaPl = Orden::whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->where('mesa', '=', 'Para llevar')->sum('total');
        $ventaDPl = Orden::where('fecha', Carbon::today())->where('mesa', '=', 'Para llevar')->sum('total');
        $cancelado = ComandaTemporal::whereMonth('fecha', Carbon::now())->where('status', 'Cancelado')->count();
        $canceladoD = ComandaTemporal::whereDay('fecha', Carbon::now())->where('status', 'Cancelado')->count();
        $event = Calendar::select('id')->whereMonth('updated_at', Carbon::now())->whereYear('updated_at', Carbon::today())->count();
        $eventD = Calendar::select('id')->whereDay('updated_at', Carbon::today())->whereMonth('updated_at', Carbon::today())->whereYear('updated_at', Carbon::today())->count();
        $producto = Producto::select('titulo')->count();
        $eliminado = ComandaTemporal::whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->count();
        $eliminadoD = ComandaTemporal::whereDay('fecha', Carbon::now())->whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->count();
        $mesasC = OrdenCancelado::whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->count();
        $mesasCD = OrdenCancelado::whereMonth('fecha', Carbon::now())->whereDay('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->count();
        $ventaApps = Orden::whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('total');
        $ventaAppsD = Orden::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('total');
        $descuento = Orden::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->sum('descuento_pesos');
        $descuentoD = Orden::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->sum('descuento_pesos');
        $propina = Orden::whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->sum('propina');
        $propinaD = Orden::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->sum('propina');


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

    public function createEvents(){
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
