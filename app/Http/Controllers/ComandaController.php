<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Mesa;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\PayMethod;
use App\Models\Comanda;
use App\Models\Pedido;

class ComandaController extends Controller
{

    public function index()    {
        $comanda = Comanda::all();
        $mesa = Mesa::all();
        $cta = CategoriaProducto::all();
        $producto = Producto::all();
        $pray = PayMethod::all();
        $precio = PrecioProducto::all();
        $orden = Pedido::all();
        return view('comanda.index', compact('comanda', 'mesa','cta','producto','pray','precio','orden'));
    }

    public function create()
    {
       //
    }

    public function store(Request $request)
    {
//            $orden = new Pedido;
//            $orden->fecha = $request->get('fecha');
//            $orden->mesa_id = $request->get('mesa_id');
//            $orden->cajero = $request->get('cajero');
//            $orden->forma_pago = $request->get('forma_pago');
//            $orden->propina = $request->get('propina');
//            $orden->total = $request->get('total');
//            $orden->save;
//        return response()->json(['success' => 'Exito' ]);
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
        //
    }
}
