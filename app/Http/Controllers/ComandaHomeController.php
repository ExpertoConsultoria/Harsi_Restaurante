<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mesa;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Comanda;
use App\Models\PayMethod;
use App\Models\ComandaTemporal;
use App\Models\Estado;
use App\Models\Orden;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;


class ComandaHomeController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        if ($request->input('articulo') != null) {
            $articulos = implode(',', $request->input('articulo'));
        }

        $pedido = new Pedido;
        $pedido->fecha = $request->fecha;
        $pedido->mesa = $request->mesa;
        $pedido->cajero = $request->cajero;
        $pedido->turno = $request->turno;
        $pedido->forma_pago = $request->forma_pago;
        $pedido->cliente = $request->cliente;
        $pedido->direccion = $request->direccion;
        $pedido->comentario = $request->comentario;
        if ($request->reducir != 'No') {
            $pedido->conf_total = $request->total1;
        } else {
            $pedido->conf_total = $request->conf_total;
        }
        $pedido->descuento = $request->descuento;
        $pedido->motivo_descuento = $request->motivoDescuento;
        $pedido->descuento_pesos = $request->descuento1;
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
            //$ingreso->id del ingreso que recien se guardo
            $detalle->pedido_id = $pedido->id;
            //id_articulo de la posición cero
            $detalle->articulo = $articulo[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio_compra = $precio_compra[$cont];
            $detalle->subtotal = $subtotal[$cont];
            $detalle->save();

            $procant = $cantidad[$cont] . " " . $articulo[$cont];
            $articantidad[] = $procant;
            $cadena = implode(", ", $articantidad);
            Orden::where('id', $pedido->id)->update(['articulo' => $cadena]);

            $cont = $cont + 1;
        }
        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function guardarConsumo(Request $request)
    {
        if ($request->input('articulo') != null) {
            $articulos = implode(',', $request->input('articulo'));
        }

        $pedido = new Pedido;
        $pedido->fecha = $request->fecha;
        $pedido->mesa = $request->mesa;
        $pedido->cajero = $request->cajero;
        $pedido->turno = $request->turno;
        $pedido->forma_pago = $request->forma_pago;
        $pedido->cliente = $request->cliente;
        $pedido->direccion = $request->direccion;
        //$pedido->articulo =  $articulos;
        $pedido->comentario = $request->comentario;
        if ($request->reducir != 'No') {
            $pedido->conf_total = $request->total1;
        } else {
            $pedido->conf_total = $request->conf_total;
        }
        $pedido->descuento = $request->descuento;
        $pedido->motivo_descuento = $request->motivoDescuento;
        $pedido->descuento_pesos = $request->descuento1;
        $pedido->propina = $request->propina;
        $pedido->total = $request->total;
        $pedido->total2 = $request->total2;
        // $pedido->cupon = $request->cupon;
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
            //$ingreso->id del ingreso que recien se guardo
            $detalle->pedido_id = $pedido->id;
            //id_articulo de la posición cero
            $detalle->articulo = $articulo[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio_compra = $precio_compra[$cont];
            $detalle->subtotal = $subtotal[$cont];
            $detalle->save();

            $procant = $cantidad[$cont] . " " . $articulo[$cont];
            $articantidad[] = $procant;
            $cadena = implode(", ", $articantidad);
            Orden::where('id', $pedido->id)->update(['articulo' => $cadena]);

            $cont = $cont + 1;
        }
        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function guardar(Request $request)
    {
        $temporal = new ComandaTemporal;
        $temporal->fecha = $request->fecha;
        $temporal->fila = $request->indice;
        $temporal->mesa = $request->mesa;
        $temporal->estado = $request->estado;
        $temporal->cajero = $request->cajero;
        $temporal->cliente = $request->cliente;
        $temporal->direccion = $request->direccion;
        $temporal->comentario = $request->comentario;

        $temporal->articulo = $request->articulo;
        $temporal->cantidad = $request->cantidad;
        $temporal->precio_compra = $request->precio_compra;
        $temporal->subtotal = $request->subtotal;
        $temporal->save();
        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function guardarComentario(Request $request)
    {

        $comanda = ComandaTemporal::select('comanda_temporal.id')->where('comanda_temporal.mesa', '=', $request->mesa)->where('comanda_temporal.estado', '=', 'Abierta')->where('comanda_temporal.status', '=', 'Disponible')->count();

        if ($comanda == 0) {
            $temporal = new ComandaTemporal;
            $temporal->fecha = $request->fecha;
            $temporal->mesa = $request->mesa;
            $temporal->estado = $request->estado;
            $temporal->cajero = $request->cajero;
            $temporal->cliente = $request->cliente;
            $temporal->direccion = $request->direccion;
            $temporal->comentario = $request->comentario;
            $temporal->save();
        }

        ComandaTemporal::where('mesa', '=', $request->mesa)->where('estado', '=', 'Abierta')->where('status', '=', 'Disponible')->update(['comentario' => $request->comentario]);

        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function obtener($mesa)
    {
        $comanda = ComandaTemporal::select(
            'id',
            'fila',
            'estado',
            'fecha',
            'mesa',
            'cajero',
            'cliente',
            'direccion',
            'articulo',
            'cantidad',
            'precio_compra',
            'subtotal',
            'comentario'
        )
            ->where('mesa', '=', $mesa)
            ->where('estado', '=', 'Abierta')
            ->where('status', '=', 'Disponible')
            ->get();
        return Response()->json($comanda);
    }

    public function guardarextra(Request $request)
    {
        $temporal = new ComandaTemporal;
        $temporal->fecha = $request->fecha;
        $temporal->fila = $request->indice;
        $temporal->mesa = $request->mesa;
        $temporal->estado = $request->estado;
        $temporal->cajero = $request->cajero;
        $temporal->cliente = $request->cliente;
        $temporal->direccion = $request->direccion;
        $temporal->comentario = $request->comentario;

        $temporal->articulo = $request->articulo;
        $temporal->cantidad = $request->cantidad;
        $temporal->precio_compra = $request->precio_compra;
        $temporal->subtotal = $request->subtotal;
        $temporal->save();
        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function eliminar(Request $request)
    {
        $temporal = ComandaTemporal::where('mesa', '=', $request->mesa)
            ->where('estado', '=', 'Abierta')
            ->where('fila', '=', $request->indice)
            ->update([
                'status' => 'Eliminado',
                'estado' => 'Cerrada',
                'motivo' => $request->motivo
            ]);

        return response()->json($temporal);
    }
}
