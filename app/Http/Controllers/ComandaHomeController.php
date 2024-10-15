<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\ComandaTemporal;
use App\Models\Orden;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ComandaHomeController extends Controller
{

    public function store(Request $request) {

        // Guardamos todo el Servicio
        $pedido = new Pedido;
            $pedido->fecha = $request->fecha;
            $pedido->mesa = $request->mesa;
            $pedido->cajero = $request->cajero;
            $pedido->turno = $request->turno;
            $pedido->forma_pago = $request->forma_pago;

            $pedido->guia_id = $request->guide;
            $pedido->comision_percentage = $request->comision;
            $pedido->mesero_id = $request->mesero;
            $pedido->num_comensales = $request->comensales;

            $pedido->cliente = $request->cliente;
            $pedido->direccion = $request->direccion;
            $pedido->comentario = $request->comentario;

            $pedido->conf_total = $request->conf_total;
            $pedido->descuento = $request->descuento;
            $pedido->comision = $request->comision_price;
            $pedido->motivo_descuento = $request->motivoDescuento;
            $pedido->descuento_pesos = $request->descuento1;
            $pedido->propina = $request->propina;
            $pedido->total = $request->total;
            $pedido->total2 = $request->total2;
            $pedido->pago = $request->pago;
            $pedido->cambio = $request->cambio;

            $pedido->save();

        // Obtenemos el resumen de Productos[]
        $articulo = $request->get('articulo');
        $cantidad = $request->get('cantidad');
        $precio_compra = $request->get('precio_compra');
        $subtotal = $request->get('subtotal');
        $preparation_specifications = $request->get('preparation_specifications');

        $cont = 0;

        while ($cont < count($articulo)) {

            // Guardamos cada Comanda de forma Individual
            $detalle = new Comanda;
                $detalle->pedido_id = $pedido->id;
                $detalle->articulo = $articulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->subtotal = $subtotal[$cont];
                $detalle->preparation_specifications = $preparation_specifications[$cont];
                $detalle->save();

            $procant = $cantidad[$cont] . " " . $articulo[$cont];
            $articantidad[] = $procant;
            $cadena = implode(", ", $articantidad);

            // Guardamos el resumen plano de la orden
            Orden::where('id', $pedido->id)->update(['articulo' => $cadena]);

            $cont = $cont + 1;
        }

        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function guardar(Request $request) {

        $temporal = new ComandaTemporal;
        $temporal->fecha = $request->fecha;
        $temporal->fila = $request->indice;
        $temporal->mesa = $request->mesa;
        $temporal->estado = $request->estado;
        $temporal->cajero = $request->cajero;

        $temporal->guia_id = $request->guide;
        $temporal->comision_percentage = $request->comision;
        $temporal->mesero_id = $request->mesero;
        $temporal->num_comensales = $request->comensales;

        $temporal->cliente = $request->cliente;
        $temporal->direccion = $request->direccion;
        $temporal->comentario = $request->comentario;

        $temporal->articulo = $request->articulo;
        $temporal->cantidad = $request->cantidad;
        $temporal->precio_compra = $request->precio_compra;
        $temporal->subtotal = $request->subtotal;
        $temporal->preparation_specifications = $request->preparation_specifications;

        $temporal->save();

        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function guardarComentario(Request $request) {

        $comanda = ComandaTemporal::where([
            ['mesa', '=', $request->mesa],
            ['estado', '=', 'Abierta'],
            ['status', '=', 'Disponible']
        ])->count();

        if ($comanda == 0) {
            $temporal = new ComandaTemporal;
            $temporal->fecha = $request->fecha;
            $temporal->mesa = $request->mesa;
            $temporal->estado = $request->estado;
            $temporal->cajero = $request->cajero;

            $temporal->guia_id = $request->guide;
            $temporal->comision_percentage = $request->comision;
            $temporal->mesero_id = $request->mesero;
            $temporal->num_comensales = $request->comensales;

            $temporal->cliente = $request->cliente;
            $temporal->direccion = $request->direccion;
            $temporal->comentario = $request->comentario;
            $temporal->save();

            return;
        }

        ComandaTemporal::where([
            ['mesa', '=', $request->mesa],
            ['estado', '=', 'Abierta'],
            ['status', '=', 'Disponible']
        ])->update(['comentario' => $request->comentario]);

        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa.');
    }

    public function obtener($mesa) {

        $comanda = ComandaTemporal::select(
            'id',
            'fila',
            'estado',
            'fecha',
            'mesa',
            'cajero',
            'guia_id',
            'comision_percentage',
            'mesero_id',
            'num_comensales',
            'cliente',
            'direccion',
            'articulo',
            'cantidad',
            'precio_compra',
            'subtotal',
            'preparation_specifications',
            'comentario'
        )
            ->where('mesa', '=', $mesa)
            ->where('estado', '=', 'Abierta')
            ->where('status', '=', 'Disponible')
            ->get();

        return Response()->json($comanda);
    }

    public function guardarextra(Request $request) {

        $temporal = new ComandaTemporal;
        $temporal->fecha = $request->fecha;
        $temporal->fila = $request->indice;
        $temporal->mesa = $request->mesa;
        $temporal->estado = $request->estado;
        $temporal->cajero = $request->cajero;

        $temporal->guia_id = $request->guide;
        $temporal->comision_percentage = $request->comision;
        $temporal->mesero_id = $request->mesero;
        $temporal->num_comensales = $request->comensales;

        $temporal->cliente = $request->cliente;
        $temporal->direccion = $request->direccion;
        $temporal->comentario = $request->comentario;

        $temporal->articulo = $request->articulo;
        $temporal->cantidad = $request->cantidad;
        $temporal->precio_compra = $request->precio_compra;
        $temporal->subtotal = $request->subtotal;
        $temporal->preparation_specifications = $request->preparation_specifications;
        $temporal->save();

        return redirect()->route('Ordenes.index')->with('success', 'Reservación exitosa  .');
    }

    public function eliminar(Request $request) {

        $temporal = ComandaTemporal::where('mesa', '=', $request->mesa)
            ->where('estado', '=', 'Abierta')
            ->where('fila', '=', $request->indice)
            ->update([
                'status' => 'Eliminado',
                'estado' => 'Cerrada',
                'motivo' => $request->motivo,
            ]);

        return response()->json($temporal);
    }
}
