<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Mesa;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Comanda;
use App\Models\PayMethod;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class PanelController extends Controller
{

    public function index()
    {
        $mesas = Mesa::all();
        $mesa = Mesa::all();
        $cta = CategoriaProducto::all();
        $desarrollador = \DB::table('descuento_usuario')
                    ->select('id','role', 'descuento')
                    ->where('role','Desarrollador')
                    ->first();
        $administrador= \DB::table('descuento_usuario')
                    ->select('id','role', 'descuento')
                    ->where('role','Administrador')
                    ->first();
        $cajero = \DB::table('descuento_usuario')
                    ->select('id','role', 'descuento')
                    ->where('role','Cajero')
                    ->first();
                    //dd($descuentoAdm);

        return view('/home',compact('mesas','cta','mesa','desarrollador','administrador','cajero'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $mesas = Mesa::where('id', $id)->get();
        return view('panel.edit', compact('mesas'));

    }

    public function update(Request $request, $id)
    {
        $mesas = Mesa::where('id', $id)->first();
        $mesas->titulo = $request->titulo;
        $mesas->estado = $request->estado;
        $mesas->color = '#ce0018';

        $mesas->save();

        $mesas = Mesa::all();



        return redirect()->route('Pedido.index',['mesas'=>$mesas])->with('success','Comanda Abierta');
    }

    public function destroy($id)
    {
        //
    }
}
