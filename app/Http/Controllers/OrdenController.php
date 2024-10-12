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

    public function ticketPdf() {

        $id = Orden::all()->last()->id;
        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono', 'email', 'facebook', 'instagram', 'twitter', 'youTube', 'linkedIn')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
                'email' => $restaurante->email,
                'facebook' => $restaurante->facebook,
                'instagram' => $restaurante->instagram,
                'twitter' => $restaurante->twitter,
                'youTube' => $restaurante->youTube,
                'linkedIn' => $restaurante->linkedIn,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
                'email' => '',
                'facebook' => '',
                'instagram' => '',
                'twitter' => '',
                'youTube' => '',
                'linkedIn' => '',
            );
        }

        $producto = Producto::all();

        $orden = DB::table('orden as o')
            ->join('comanda as c', 'c.pedido_id', '=', 'o.id')
            ->select('o.id', 'o.fecha', 'o.mesa', 'o.cajero', 'o.forma_pago', 'o.cliente', 'o.direccion', 'o.conf_total', 'o.descuento', 'o.propina', 'o.total', 'o.total2', 'o.pago', 'o.cambio', 'o.created_at')
            ->where('o.id', '=', $id)
            ->first();

        $pedido = DB::table('comanda as d')
            ->select('d.articulo', 'd.cantidad', 'd.precio_compra', 'd.subtotal')
            ->where('d.pedido_id', '=', $id)
            ->get();

        $pdf = PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden, 'pedido' => $pedido, 'producto' => $producto, 'restaurante' => $restaurante]);

        return $pdf->download('ticket.pdf');

    }

    public function ticketPdfshow(Request $request) {

        $id = $request->id;
        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono', 'email', 'facebook', 'instagram', 'twitter', 'youTube', 'linkedIn')
                ->first();

            $nombre = $restaurante->nombre;
            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
                'email' => $restaurante->email,
                'facebook' => $restaurante->facebook,
                'instagram' => $restaurante->instagram,
                'twitter' => $restaurante->twitter,
                'youTube' => $restaurante->youTube,
                'linkedIn' => $restaurante->linkedIn,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
                'email' => '',
                'facebook' => '',
                'instagram' => '',
                'twitter' => '',
                'youTube' => '',
                'linkedIn' => '',
            );
            $nombre = '';
        }

        if (Auth::check() && Auth::user()->role == 'administrador') {

            $producto = Producto::all();

            $orden = DB::table('orden as o')
                ->join('comanda as c', 'c.pedido_id', '=', 'o.id')
                ->select('o.id', 'o.fecha', 'o.mesa', 'o.cajero', 'o.forma_pago', 'o.cliente', 'o.direccion', 'o.conf_total', 'o.descuento', 'o.propina', 'o.total', 'o.total2', 'o.pago', 'o.cambio', 'o.created_at')
                ->where('o.id', '=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
                ->select('d.articulo', 'd.cantidad', 'd.precio_compra', 'd.subtotal')
                ->where('d.pedido_id', '=', $id)
                ->get();

            $asunto = "Su consumo en restaurante: " . $nombre;

            $pdf = PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden, 'pedido' => $pedido, 'producto' => $producto, 'restaurante' => $restaurante]);

            $email = $request->email;

            Mail::to($request->email)->send(new SendMailTicket($restaurante, $asunto, $pdf));
        }

        if (Auth::check() && Auth::user()->role == 'cajero') {

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c', 'c.pedido_id', '=', 'o.id')
                ->select('o.id', 'o.fecha', 'o.mesa', 'o.cajero', 'o.forma_pago', 'o.cliente', 'o.direccion', 'o.conf_total', 'o.descuento', 'o.propina', 'o.total', 'o.total2', 'o.pago', 'o.cambio', 'o.created_at')
                ->where('o.id', '=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
                ->select('d.articulo', 'd.cantidad', 'd.precio_compra', 'd.subtotal')
                ->where('d.pedido_id', '=', $id)
                ->get();

            $asunto = "Su consumo en restaurante: " . $nombre;

            $pdf = PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden, 'pedido' => $pedido, 'producto' => $producto, 'restaurante' => $restaurante]);

            $email = $request->email;
            Mail::to($request->email)->send(new SendMailTicket($restaurante, $asunto, $pdf));
        } else {
            return view('error');
        }
    }

    public function enviarTicket(Request $request) {

        $id = Orden::all()->last()->id;
        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono', 'email', 'facebook', 'instagram', 'twitter', 'youTube', 'linkedIn')
                ->first();
            $nombre = $restaurante->nombre;

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
                'email' => $restaurante->email,
                'facebook' => $restaurante->facebook,
                'instagram' => $restaurante->instagram,
                'twitter' => $restaurante->twitter,
                'youTube' => $restaurante->youTube,
                'linkedIn' => $restaurante->linkedIn,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
                'email' => '',
                'facebook' => '',
                'instagram' => '',
                'twitter' => '',
                'youTube' => '',
                'linkedIn' => '',
            );
            $nombre = '';
        }

        $producto = Producto::all();

        $orden = DB::table('orden as o')
            ->join('comanda as c', 'c.pedido_id', '=', 'o.id')
            ->select('o.id', 'o.fecha', 'o.mesa', 'o.cajero', 'o.forma_pago', 'o.cliente', 'o.direccion', 'o.conf_total', 'o.descuento', 'o.propina', 'o.total', 'o.total2', 'o.pago', 'o.cambio', 'o.created_at')
            ->where('o.id', '=', $id)
            ->first();

        $pedido = DB::table('comanda as d')
            ->select('d.articulo', 'd.cantidad', 'd.precio_compra', 'd.subtotal')
            ->where('d.pedido_id', '=', $id)
            ->get();

        $asunto = "Su consumo en restaurante: " . $nombre;

        $pdf = PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden, 'pedido' => $pedido, 'producto' => $producto, 'restaurante' => $restaurante]);

        $email = $request->email;
        Mail::to($request->email)->send(new SendMailTicket($restaurante, $asunto, $pdf));
    }

    public function invoice() {

        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";

        $view = View::make('Ordenes.invoice', compact('data', 'date', 'invoice'))->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->download('invoice.pdf');
    }

    public function getData() {
        $data = [
            'quantity' => '1',
            'description' => 'some ramdom text',
            'price' => '500',
            'total' => '500',
        ];
        return $data;
    }

    public function destroy($id) {
        $data = Orden::findOrFail($id);
        $data->delete();
        return redirect()->route('Ordenes.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}
