<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index() {

        if (Auth::check()) {
            return view('/Setting');
        } else {
            return view('error');
        }
    }

    public function grafica(Request $request) {
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
