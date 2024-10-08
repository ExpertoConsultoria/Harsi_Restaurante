<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Orden;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserChartController extends Controller
{
    public function index() {
        $mesas = Orden::select('mesa')->get();
        $orden = Orden::whereMonth('fecha', Carbon::now())->count();

        return view('Graficas.index', compact('mesas', 'orden'));
    }

    public function chart(Request $request) {

        $mas_vendidos = DB::select('
                SELECT comanda.articulo, SUM(comanda.cantidad) AS TotalVentas
                FROM comanda
                GROUP BY comanda.articulo
                ORDER BY SUM(comanda.cantidad) DESC
                LIMIT 0 , 10;');
        return response()->json($mas_vendidos);
    }

    public function menosVendido(Request $request) {
        $menos_vendidos = DB::select('
            SELECT productos.titulo, SUM(comanda.cantidad) AS Menos
            FROM comanda
            INNER JOIN 	productos  ON productos.id = comanda.articulo_id
            GROUP BY comanda.articulo_id
            ORDER BY SUM(comanda.cantidad) ASC
            LIMIT 0 , 5;
            ');

        return response()->json($menos_vendidos);
    }

    public function orden(Request $request) {
        $orden = DB::select('
            SELECT COUNT(*) AS contador,
            MONTH(fecha) AS mes
            FROM orden
            WHERE YEAR(fecha)= 2019
            GROUP BY MONTH(fecha)
            ORDER BY MONTH(fecha) ASC;
            ');
        return response()->json($orden);
    }

}
