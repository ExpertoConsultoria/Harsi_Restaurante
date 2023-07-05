<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;
use App\CategoriaProducto;
use App\Producto;
use App\PrecioProducto;
use App\Pedido;
use App\Comanda;
use App\ComandaEsp;
use App\PayMethod;
use App\Estado;
use DataTables;
use Validator;


class ComandaEspController extends Controller
{
    public function index()
    {
        $mesa = Mesa::all();
        $cta = CategoriaProducto::all();
        $producto = Producto::all();
        $precioP = PrecioProducto::all();
        $pedido = Pedido::all();
        $paymethod = PayMethod::all();
        $estado = Estado::all();
        $comanda = Comanda::all();
        $comandaesp = ComandaEsp::All();
        
//        return view('Pedido.index', compact('orden','mesa','producto','precioP',
//            'cta','pedido','paymethod','estado','comanda','comandaesp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
//        $pedido = new Pedido;
//        $pedido->fecha = $request->fecha;
//        $pedido->mesa = $request->mesa;
//        $pedido->cajero = $request->cajero;
//        $pedido->forma_pago = $request->forma_pago;
//        $pedido->propina = $request->propina;
//        $pedido->total = $request->total;
//        $pedido->pago = $request->pago;
//        $pedido->cambio = $request->cambio;
//        $pedido->save();
        
        $producto = $request->get('producto'); //array()
        $cant = $request->get('cant');
        $precio_c = $request->get('precio_c');
        $sub_total = $request->get('sub_total');
        
        $contador = 0;
        
            while($contador < count($producto))
            {
                $ingreso = new ComandaEsp;
                
                $ingreso->pedido_id = $pedido->id;
                $ingreso->producto = $producto[$contador];
                $ingreso->cant = $cant[$contador];
                $ingreso->precio_c = $precio_c[$contador];
                $ingreso->sub_total = $sub_total[$contador];
                $ingreso->save();
                
                $contador = $contador + 1;
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
