<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Mesa;
use App\Models\Orden;
use App\Models\Calendar;
use App\Models\Producto;
use App\Models\ComandaTemporal;
use App\Models\OrdenCancelado;

class SettingController extends Controller
{
    public function index()
    {

        if (Auth::check() && Auth::user()->role == 'administrador')
        {
            // dd($canceladom);
            return view('/Setting');
            // return view('/Setting', compact('user','mesa','orden','venta','event','eventD','producto','ventaD','ordenD','ventaPl','ventaDPl','cancelado','canceladoD','eliminado','eliminadoD','mesasC','mesasCD','ventaApps','ventaAppsD','descuento','descuentoD','propina','propinaD'));
        }

        if(Auth::check() && Auth::user()->role == 'cajero'){
            // $userg = User::where('role','gerente')->count();
            // $userc = User::where('role','cajero')->count();
            // $usera = User::where('role','administrador')->count();
            // $user = $userg + $userc + $usera;
            // $orden = Orden::whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->count();
            // $ordenD = Orden::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->count();
            // $mesa = Mesa::select('id')->count();
            // $venta = Orden::whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->sum('total');
            // $ventaD = Orden::whereDay('fecha', Carbon::today())->sum('total');
            // $ventaPl = Orden::whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->where('mesa', '=','Para llevar')->sum('total');
            // $ventaDPl = Orden::whereDay('fecha', Carbon::today())->where('mesa', '=','Para llevar')->sum('total');
            // $cancelado = ComandaTemporal::whereMonth('fecha', Carbon::now())->where('status','Cancelado')->count();
            // $canceladoD = ComandaTemporal::whereDay('fecha', Carbon::now())->where('status','Cancelado')->count();
            // $event = Calendar::select('id')->count();
            // $producto = Producto::select('titulo')->count();
            // $eliminado = ComandaTemporal::whereMonth('fecha', Carbon::now())->where('status','Eliminado')->count();
            // $eliminadoD = ComandaTemporal::whereDay('fecha', Carbon::now())->where('status','Eliminado')->count();
            // $mesasC = OrdenCancelado::whereMonth('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->count();
            // $mesasCD = OrdenCancelado::whereMonth('fecha', Carbon::now())->whereDay('fecha', Carbon::now())->whereYear('fecha', Carbon::today())->count();
            // return view('/Setting', compact('user','mesa','orden','venta','event','producto','ventaD','ordenD','ventaPl','ventaDPl','cancelado','canceladoD','eliminado','eliminadoD','mesasC','mesasCD'));

            return view('/Setting');
        }
        else{
            return view('error');
        }
    }

    public function grafica (Request $request)
    {
        $mas_vendidos = DB::select('
            SELECT COUNT(*) AS contador,
            MIN(2019) AS DESDE,
            MAX(2020) AS HASTA,
            MONTH(fecha) AS mes
            FROM orden
            WHERE YEAR(fecha)= 2019
            GROUP BY MONTH(fecha)
            ORDER BY MONTH(fecha) ASC;');
        return response()->json($mas_vendidos);

    }

}

