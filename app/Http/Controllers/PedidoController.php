<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Comanda;
use App\Models\Estado;
use App\Models\Mesa;
use App\Models\Orden;
use App\Models\PayMethod;
use App\Models\Pedido;
use App\Models\Producto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function index() {
        if (Auth::check() && Auth::user()->role == 'administrador') {
            $orden = Orden::all();
            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $ctaesp = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();
            $estado = Estado::all();
            $pro = Producto::all();

            if (request()->ajax()) {
                return datatables()->of(Pedido::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Pedido.index', compact('orden', 'mesa', 'producto',
                'cta', 'pedido', 'paymethod', 'estado', 'ctaesp', 'pro'));
        }

        if (Auth::check() && Auth::user()->role == 'cajero') {
            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $ctaesp = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();
            $estado = Estado::all();

            if (request()->ajax()) {
                return datatables()->of(Pedido::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Pedido.index', compact('orden', 'mesa', 'producto',
                'cta', 'pedido', 'paymethod', 'estado', 'ctaesp'));
        } else {
            return view('error');
        }
    }

    public function create($id) {

        if (Auth::check() && Auth::user()->role == 'administrador') {
            $mesasupdate = Mesa::where('id', $id)->first();
            $mesasupdate->estado = 'Abierta';
            $mesasupdate->color = '#ce0018';
            $mesasupdate->save();

            $mesas = Mesa::all();

            $comanda = Mesa::where('id', $id)->first();

            $orden = Orden::all();
            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $ctaesp = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();
            $estado = Estado::all();
            $pro = Producto::all();

            if (request()->ajax()) {
                return datatables()->of(Pedido::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Pedido.index', compact('orden', 'mesa', 'producto',
                'cta', 'pedido', 'paymethod', 'estado', 'ctaesp', 'pro', 'comanda', 'mesas'));
        }

        if (Auth::check() && Auth::user()->role == 'cajero') {
            $mesasupdate = Mesa::where('id', $id)->first();
            $mesasupdate->estado = 'Abierta';
            $mesasupdate->color = '#ce0018';
            $mesasupdate->save();

            $mesas = Mesa::all();

            $comanda = Mesa::where('id', $id)->first();
            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $ctaesp = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();
            $estado = Estado::all();

            if (request()->ajax()) {
                return datatables()->of(Pedido::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Pedido.index', compact('orden', 'mesa', 'producto',
                'cta', 'pedido', 'paymethod', 'estado', 'ctaesp', 'comanda', 'mesas'));
        } else {
            return view('error');
        }

    }

    public function store(Request $request) {

        $pedido = new Pedido;
            $pedido->fecha = $request->fecha;
            $pedido->mesa = $request->mesa;
            $pedido->cajero = $request->cajero;
            $pedido->forma_pago = $request->forma_pago;
            $pedido->conf_total = $request->conf_total;
            $pedido->descuento = $request->descuento;
            $pedido->propina = $request->propina;
            $pedido->total = $request->total;
            $pedido->total2 = $request->total2;
            $pedido->pago = $request->pago;
            $pedido->cambio = $request->cambio;
            $pedido->save();

        $articulo = $request->get('articulo');
        $cantidad = $request->get('cantidad');
        $precio_compra = $request->get('precio_compra');
        $subtotal = $request->get('subtotal');

        $cont = 0;

        while ($cont < count($articulo)) {
            $detalle = new Comanda;
            $detalle->orden_id = $pedido->id;
            $detalle->articulo = $articulo[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio_compra = $precio_compra[$cont];
            $detalle->subtotal = $subtotal[$cont];
            $detalle->save();

            $cont = $cont + 1;
        }

        $mesa = Mesa::where('estado', 'Cerrada')->first();
        $mesa->estado = 'Abierta';
        $mesa->color = '#27a243';
        $mesa->save();

        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

}
