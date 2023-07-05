<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\ComandaCancelado;
use App\Models\ComandaTemporal;
use App\Models\Mesa;
use App\Models\OrdenCancelado;
use App\Models\PayMethod;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Restaurante;
use App\Models\Room;
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

    public function inicio()
    {
        $dato = User::min('id');
        if ($dato != null) {
            $user = \DB::table('users')
                ->select('id', 'name', 'role', 'expiracion')
                ->where('role', 'administrador')
                ->first();
            //dd($user);
            if ($user->expiracion != null) {

                $fecha = Carbon::parse($user->expiracion);
                $fecha = strtotime($fecha);
                $hoy = Carbon::today();
                $hoy = strtotime($hoy);
                $diferiencia = $fecha - $hoy;
                $dias = $diferiencia / 86400;
                $total = floor($dias);
                //$diff = $fecha->diffInDays($hoy);
                //$dias =date_diff($fecha, $hoy)->format('%R%a');
                if ($total <= 10) {
                    $mensaje = 'Faltan ' . $total . ' días para que el sistema expire!';

                } else {
                    $mensaje = '';
                }
                //dd($mensaje);
            } else {
                $user = array(
                    'id' => 0,
                    'name' => '',
                    'role' => '',
                    'expiracion' => '',
                );
                $mensaje = '';
                $total = '';
            }

        }
        //$prueba = Prueba::all();
        //dd($prueba);
        return view('inicio', compact('mensaje', 'total'));
    }

    public function index()
    {
        if (Auth::check() && Auth::user()->role == 'desarrollador') {
            $mesas = Mesa::all();
            $mesa = Mesa::all();
            $mesaedit = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $desarrollador = \DB::table('descuento_usuario')
                ->select('id', 'role', 'descuento')
                ->where('role', 'Desarrollador')
                ->first();
            $dato = Restaurante::min('id');
            if ($dato != null) {
                $restaurante = \DB::table('restaurante')
                    ->select('subcategoria', 'reducir')
                    ->first();
                if ($restaurante->subcategoria != null) {
                    $restaurante = array(
                        'subcategoria' => $restaurante->subcategoria,
                        'reducir' => $restaurante->reducir,
                    );
                }

            } else {
                $restaurante = array(
                    'subcategoria' => 'No',
                    'reducir' => 'No',
                );
            }

            return view('/home', compact('mesas', 'mesa', 'producto',
                'cta', 'pedido',  'mesaedit', 'desarrollador', 'restaurante'));
        }
        if (Auth::check() && Auth::user()->role == 'administrador') {

            $mesas = Mesa::all();
            $mesa = Mesa::all();
            $mesaedit = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $administrador = \DB::table('descuento_usuario')
                ->select('id', 'role', 'descuento')
                ->where('role', 'Administrador')
                ->first();

            $dato = Restaurante::min('id');

            if ($dato != null) {
                $restaurante = \DB::table('restaurante')
                    ->select('subcategoria', 'reducir', 'hotel')
                    ->first();

                if ($restaurante->subcategoria != null) {
                    $restaurante = array(
                        'subcategoria' => $restaurante->subcategoria,
                        'reducir' => $restaurante->reducir,
                        'hotel' => $restaurante->hotel,
                    );
                }

            } else {
                $restaurante = array(
                    'subcategoria' => 'No',
                    'reducir' => 'No',
                    'hotel' => 'No',
                );
            }

            return view('/home', compact('mesas', 'mesa', 'producto',
                'cta', 'pedido',  'mesaedit', 'administrador', 'restaurante'));
        }
        if (Auth::check() && Auth::user()->role == 'cajero') {
            $mesas = Mesa::all();
            $mesa = Mesa::all();
            $mesaedit = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $cajero = \DB::table('descuento_usuario')
                ->select('id', 'role', 'descuento')
                ->where('role', 'Cajero')
                ->first();
            $dato = Restaurante::min('id');
            if ($dato != null) {
                $restaurante = \DB::table('restaurante')
                    ->select('subcategoria', 'reducir')
                    ->first();
                if ($restaurante->subcategoria != null) {
                    $restaurante = array(
                        'subcategoria' => $restaurante->subcategoria,
                        'reducir' => $restaurante->reducir,
                    );
                }

            } else {
                $restaurante = array(
                    'subcategoria' => 'No',
                    'reducir' => 'No',
                );
            }

            return view('/home', compact('mesas', 'mesa', 'producto',
                'cta', 'pedido',  'mesaedit', 'cajero', 'restaurante'));
        } else {
            return view('welcome');
        }
    }
    public function productos(Request $request, $id_categoria)
    {
        $restaurante = \DB::table('restaurante')
            ->select('subcategoria')
            ->first();
        if ($restaurante->subcategoria != 'Si') {
            if ($request->ajax()) {
                $productos = \DB::table('productos')
                    ->select('id', 'titulo')
                    ->where('category_id', $id_categoria)
                    ->get();
                return Response()->json($productos);
            }
        } else {
            if ($request->ajax()) {
                $productos = \DB::table('productos')
                    ->select('id', 'titulo')
                    ->where('subcategory_id', $id_categoria)
                    ->get();
                return Response()->json($productos);
            }
        }
    }

    public function precio(Request $request, $id_producto)
    {
        if ($request->ajax()) {
            $precio = \DB::table('productos')
                ->select('titulo', 'precio')
                ->where('id', $id_producto)
                ->first();
            return Response()->json($precio);
        }
    }

    public function create($id)
    {
        if (Auth::check() && Auth::user()->role == 'desarrollador') {
            $mesas = Mesa::all();
            $mesa = Mesa::all();
            $mesaedit = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();

            return view('home', compact('mesas', 'mesa', 'producto', 'precioP',
                'cta', 'pedido', 'paymethod', 'mesaedit'));
        }
        if (Auth::check() && Auth::user()->role == 'administrador') {
            $mesasupdate = Mesa::where('id', $id)->first();
            $mesasupdate->estado = 'Abierta';
            $mesasupdate->color = '#ce0018';
            $mesasupdate->save();

            $comanda = Mesa::where('id', $id)->first();

            $mesas = Mesa::all();
            $mesa = Mesa::all();
            $mesaedit = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();

            return view('home', compact('mesas', 'mesa', 'producto',
                'cta', 'pedido', 'paymethod', 'mesaedit', 'comanda'));
        }
        if (Auth::check() && Auth::user()->role == 'cajero') {

            $comanda = Mesa::where('id', $id)->first();
            $mesas = Mesa::all();
            $mesa = Mesa::all();
            $mesaedit = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto = Producto::all();
            $pedido = Pedido::all();
            $paymethod = PayMethod::all();

            return view('home', compact('mesas', 'mesa', 'producto',
                'cta', 'pedido', 'paymethod', 'mesaedit', 'comanda'));
        } else {
            return view('welcome');
        }
    }

    public function editMesa($id)
    {
        $mesaedit = Mesa::find('id', $id)->get();
        return response()->json(['mesaedit' => $mesaedit]);
    }

    public function datos(Request $request)
    {
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

    public function update(Request $request)
    {
        if ($request->ajax()) {

            $form_data = array(
                'titulo' => $request->tituloMesa,
                'estado' => 'Cerrada',
                'color' => '#008000',
            );

            $temporal = ComandaTemporal::where('mesa', $request->tituloMesa)->update(['estado' => 'Cerrada']);
            $update = Mesa::where('titulo', $request->tituloMesa)->update($form_data);
            //$update= Mesa::whereId($request->tituloMesa)->update($form_data);
            return response()->json($update);
        }
    }

    public function cerrar(Request $request)
    {
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

            //$update= Mesa::whereId($request->tituloMesa)->update($form_data);
            //'status'=>'Eliminado','estado'=>'Cerrada'
            return response()->json($update);
        }
    }

    public function ordenCancelada(Request $request)
    {

        $pedido = new OrdenCancelado;
        $pedido->fecha = $request->fecha;
        $pedido->mesa = $request->mesa;
        $pedido->cajero = $request->cajero;
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

    public function manual()
    {

        if (file_exists(public_path() . 'Manual/output (10).pdf')) {
            $path = public_path() . 'Manual/output (10).pdf';
            return response()->download($path);
        }
        return redirect('/Manual')->with('status', 'El archivo no existe ');
    }

}
