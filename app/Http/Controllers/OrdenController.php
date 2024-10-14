<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Comanda;
use App\Models\Mesa;
use App\Models\Orden;
use App\Models\PayMethod;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Restaurante;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\SendMailTicket;


class OrdenController extends Controller
{
    public function index(Request $request) {

        if (Auth::check()) {

            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $paymethod = PayMethod::all();
            $pedido = Pedido::all();
            $orden = Orden::all();
            $restaurante = Restaurante::all();

            if (request()->ajax()) {
                return datatables()->of(Orden::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '
                            <a
                                name="showTicket"
                                id="' . $data->id . '"
                                class="btn btn-success btn-sm"
                                href="/Ordenes/' . $data->id . '"
                                target="_blank"
                            >
                                <i class="fas fa-print"></i>
                            </a>
                        ';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '
                            <button
                                type="button"
                                name="delete"
                                id="' . $data->id . '"
                                class="delete btn btn-danger btn-sm"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        ';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('Ordenes.index', compact('orden', 'mesa', 'producto',
                'cta', 'pedido', 'paymethod', 'orden', 'restaurante'));

        } else {
            return view('error');
        }
    }

    public function show($id) {

        if (Auth::check()) {
            $restaurante = Restaurante::first();

            $orden = Orden::where('id', $id)->first();

            $pedidos = Comanda::where('pedido_id', $id)->get();
            $pedido_count = Comanda::where('pedido_id', $id)->count();

            return view('Ordenes.show', ['orden' => $orden, 'pedidos' => $pedidos, 'restaurante' => $restaurante, 'pedido_count' => $pedido_count]);

        } else {
            return view('error');
        }
    }

    public function mostrar() {

        $id = Orden::all()->last()->id;

        $restaurante = Restaurante::first();

        $orden = Orden::where('id', $id)->first();

        $pedidos = Comanda::where('pedido_id', $id)->get();
        $pedido_count = Comanda::where('pedido_id', $id)->count();

        return view('Ordenes.show', ['orden' => $orden, 'pedidos' => $pedidos, 'restaurante' => $restaurante, 'pedido_count' => $pedido_count]);

    }

    public function edit($id) {
        if (request()->ajax()) {
            $data = Orden::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function destroy($id) {
        $data = Orden::findOrFail($id);
        $data->delete();
        return redirect()->route('Ordenes.index')->with('success', 'Orden eliminada exitosamente.');
    }
}
