<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\DetalleOrden;
use App\Models\Orden;


class DetalleOrdenController extends Controller
{
    public function index()
    {
        $producto = Producto::all();
        $pedido = Pedido::all();
        $orden = Orden::all();
        $detalleorden = DetalleOrden::all();
        if(request()->ajax()){
            return datatables()->of(DetalleOrden::latest()->get())
                ->addColumn('title',function($producto){
                    return $producto->Producto->titulo;
                })
                ->addColumn('action', function($data){
//                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-ms">Editar</button>';
//                    $button .= '&nbsp;&nbsp;';
                    $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('DetalleOrden.index', compact('detalleorden','producto','pedido','orden'));
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = DetalleOrden::findOrFail($id);
        $data->delete();
    }
}
