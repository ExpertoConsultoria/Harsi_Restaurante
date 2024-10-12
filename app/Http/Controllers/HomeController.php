<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\ComandaCancelado;
use App\Models\ComandaTemporal;
use App\Models\DescuentoUsuario;
use App\Models\Guia;
use App\Models\Mesa;
use App\Models\Mesero;
use App\Models\OrdenCancelado;
use App\Models\PayMethod;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Restaurante;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio() {

        $dato = User::min('id'); // Obtenemos el Usuario Administrador Base

        if ($dato != null) {

            $user = User::select('id', 'name', 'role', 'expiracion')
                ->where('role', 'administrador')
                ->first();

            if ($user->expiracion != null) {

                $expiration_date = Carbon::parse($user->expiracion);
                $expiration_date = strtotime($expiration_date);
                $current_date = Carbon::today();
                $current_date = strtotime($current_date);
                $days_difference = $expiration_date - $current_date;
                $days_difference = $days_difference / 86400;
                $days_left = floor($days_difference);

                if ($days_left <= 20) {
                    $message = 'Faltan ' . $days_left . ' días para que el sistema expire!';
                } else {
                    $message = '';
                }

            } else {
                $message = '';
                $days_left = '';
            }

        }

        return view('inicio', compact('message', 'days_left'));
    }

    public function index() {

        if (Auth::check()) {
            $role = Auth::user()->role;
            $mesas = Mesa::all();
            $product_categories = CategoriaProducto::all();
            $producto = Producto::all();
            $meseros = Guia::all();
            $guias = Mesero::all();

            // Obtener el descuento basado en el rol
            $descuento = DescuentoUsuario::where('role', $role)
                ->select('id', 'role', 'descuento')
                ->first();

            // Obtener los datos del restaurante
            $dato = Restaurante::min('id');

            if ($dato != null) {
                $restaurante = Restaurante::select('subcategoria')
                    ->first();

                if ($restaurante->subcategoria != null) {
                    $restaurante = array(
                        'subcategoria' => $restaurante->subcategoria
                    );
                }
            } else {
                $restaurante = array(
                    'subcategoria' => 'No'
                );
            }

            return view('/home', compact('mesas', 'producto', 'product_categories', 'descuento', 'restaurante', 'meseros', 'guias'));
        } else {
            return view('inicio');
        }
    }

    public function productos(Request $request, $id_categoria) {

        $restaurante = Restaurante::select('subcategoria')->first();

        if ($restaurante->subcategoria != 'Si') {

            if ($request->ajax()) {
                $productos = Producto::select('id', 'titulo')
                    ->where('category_id', $id_categoria)
                    ->get();

                return Response()->json($productos);
            }

        } else {

            if ($request->ajax()) {
                $productos = Producto::select('id', 'titulo')
                    ->where('subcategory_id', $id_categoria)
                    ->get();

                return Response()->json($productos);
            }

        }
    }

    public function precio(Request $request, $id_producto) {
        if ($request->ajax()) {
            $precio = Producto::select('titulo', 'precio')
                ->where('id', $id_producto)
                ->first();
            return Response()->json($precio);
        }
    }

    public function create($id) {

        if (Auth::check()) {
            $comanda = Mesa::find($id);
            $mesas = Mesa::all();
            $mesaedit = $mesas; // Reutilizamos la misma consulta para 'mesas' y 'mesaedit'
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();

            if (Auth::user()->role == 'administrador') {
                $comanda->estado = 'Abierta';
                $comanda->color = '#ce0018';
                $comanda->save();
            }

            return view('home', compact('mesas', 'mesaedit', 'producto', 'cta', 'pedido', 'paymethod', 'comanda'));
        }

        return view('inicio');
    }

    public function editMesa($id) {
        $mesaedit = Mesa::find('id', $id)->get();
        return response()->json(['mesaedit' => $mesaedit]);
    }

    public function datos(Request $request) {
        if ($request->ajax()) {

            $form_data = array(
                'titulo' => $request->tituloMesa,
                'estado' => 'Abierta',
                'color' => '#ce0018',
            );

            $update = Mesa::whereId($request->idt)->update($form_data);

            return response()->json($update);
        }
    }

    public function update(Request $request) {

        if ($request->ajax()) {

            $form_data = array(
                'titulo' => $request->tituloMesa,
                'estado' => 'Cerrada',
                'color' => '#008000',
            );

            $temporal = ComandaTemporal::where('mesa', $request->tituloMesa)->update(['estado' => 'Cerrada']);
            $update = Mesa::where('titulo', $request->tituloMesa)->update($form_data);
            return response()->json($update);
        }
    }

    public function cerrar(Request $request) {
        if ($request->ajax()) {

            $form_data = array(
                'titulo' => $request->tituloMesa,
                'estado' => 'Cerrada',
                'color' => '#008000',
            );

            $motivo = $request->motivo;
            $temporal = ComandaTemporal::where('mesa', $request->tituloMesa)
                ->where('estado', '=', 'Abierta')
                ->update(['estado' => 'Cerrada', 'status' => 'Cancelado', 'motivo' => $motivo]);
            $update = Mesa::whereId($request->idt)->update($form_data);

            return response()->json($update);
        }
    }

    public function ordenCancelada(Request $request) {

        $pedido = new OrdenCancelado;
        $pedido->fecha = $request->fecha;
        $pedido->mesa = $request->mesa;
        $pedido->cajero = $request->cajero;

        $guide = Guia::find($request->guide);

        if ($guide) {
            $pedido->guia = $guide->full_name;
        } else {
            $pedido->guia = 'Ninguno'; // Manejar el caso cuando no se encuentre la guía
        }

        $mesero = Mesero::find($request->mesero);

        if ($mesero) {
            $pedido->mesero = $mesero->full_name;
        } else {
            $pedido->mesero = 'Ninguno'; // Manejar el caso cuando no se encuentre la guía
        }

        $pedido->num_comensales = $request->comensales;

        $pedido->cliente = $request->cliente;
        $pedido->direccion = $request->direccion;

        $pedido->total = $request->total1;
        $pedido->motivo = $request->motivo;
        $pedido->comentario = $request->comentario;
        $pedido->save();

        $articulo = $request->get('articulo');
        $cantidad = $request->get('cantidad');
        $precio_compra = $request->get('precio_compra');
        $subtotal = $request->get('subtotal');

        $cont = 0;
        if ($articulo != '') {

            while ($cont < count($articulo)) {
                $detalle = new ComandaCancelado;
                $detalle->orden_id = $pedido->id;
                //id_articulo de la posición cero
                $detalle->articulo = $articulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->subtotal = $subtotal[$cont];
                $detalle->save();

                $cont = $cont + 1;
            }

        }

    }

    public function manual() {

        if (file_exists(public_path() . 'Manual/output (10).pdf')) {
            $path = public_path() . 'Manual/output (10).pdf';
            return response()->download($path);
        }
        return redirect('/Manual')->with('status', 'El archivo no existe ');
    }

}
