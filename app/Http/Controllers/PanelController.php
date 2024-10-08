<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Mesa;
use App\Models\CategoriaProducto;
use App\Models\DescuentoUsuario;

class PanelController extends Controller
{

    public function index() {

        $mesas = Mesa::all();
        $mesa = Mesa::all();
        $cta = CategoriaProducto::all();
        $administrador= DescuentoUsuario::select('id','role', 'descuento')
                    ->where('role','Administrador')
                    ->first();
        $cajero = DescuentoUsuario::select('id','role', 'descuento')
                    ->where('role','Cajero')
                    ->first();

        return view('/home',compact('mesas','cta','mesa','administrador','cajero'));
    }

    public function edit($id) {
        $mesas = Mesa::where('id', $id)->get();
        return view('panel.edit', compact('mesas'));
    }

    public function update(Request $request, $id) {
        $mesas = Mesa::where('id', $id)->first();
        $mesas->titulo = $request->titulo;
        $mesas->estado = $request->estado;
        $mesas->color = '#ce0018';
        $mesas->save();

        $mesas = Mesa::all();

        return redirect()->route('Pedido.index',['mesas'=>$mesas])->with('success','Comanda Abierta');
    }
}
