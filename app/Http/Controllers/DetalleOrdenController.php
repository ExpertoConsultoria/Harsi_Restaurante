<?php

namespace App\Http\Controllers;

use App\Models\DetalleOrden;
use App\Models\Orden;
use App\Models\Pedido;
use App\Models\Producto;

use Illuminate\Http\Request;

class DetalleOrdenController extends Controller
{
    public function index() {

        $producto = Producto::all();
        $pedido = Pedido::all();
        $orden = Orden::all();
        $detalleorden = DetalleOrden::all();

        if (request()->ajax()) {
            return datatables()->of(DetalleOrden::latest()->get())
                ->addColumn('title', function ($producto) {
                    return $producto->Producto->titulo;
                })
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('DetalleOrden.index', compact('detalleorden', 'producto', 'pedido', 'orden'));
    }

    public function destroy($id) {
        $data = DetalleOrden::findOrFail($id);
        $data->delete();
    }
}
