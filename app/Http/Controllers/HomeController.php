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
use App\Models\Producto;
use App\Models\Restaurante;
use App\Models\User;

use stdClass;
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

        $admin = User::min('id'); // Obtenemos el Usuario Administrador Base

        if ($admin != null) {

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

    public function index(Request $request) {

        if (Auth::check()) {
            $role = Auth::user()->role;

            if (in_array($role, ['administrador', 'cajero'])) {
                $product_categories = CategoriaProducto::all();
                $restaurante = Restaurante::first();
                $meseros = Mesero::all();
                $guias = Guia::all();

                // Obtener el descuento basado en el rol
                $descuento = DescuentoUsuario::where('role', $role)
                    ->select('id', 'role', 'descuento')
                    ->first();

                return view('HomeViews.basic', compact('product_categories', 'descuento', 'restaurante', 'meseros', 'guias'));
            }

            if ($role === 'jefe_meseros') {

                if ($request->ajax()) {

                    $response = [];
                    $mesas = Mesa::all();

                    foreach ($mesas as $mesa) {

                        $column_data = new stdClass;
                            $column_data->table_name = $mesa->titulo; // Nombre de la Mesa

                            if($mesa->estado === 'Cerrada') {
                                $column_data->table_status = "Disponible"; // Estado de la Mesa
                                $column_data->waiter_name = "-- -- --"; // Nombre del Mesero
                                $column_data->guide_name = "-- -- --"; // Nombre del Guía
                                $column_data->subtotal = "-- -- --"; // Total por Consumo
                                $column_data->food_dishes = []; // Productos Solicitados (nombre, cantidad)
                            } else {

                                $column_data->table_status = "Ocupada"; // Estado de la Mesa
                                $column_data->waiter_name = "-- -- --"; // Nombre del Mesero
                                $column_data->guide_name = "-- -- --"; // Nombre del Guía
                                $column_data->subtotal = 0; // Total por Consumo
                                $column_data->food_dishes = []; // Productos Solicitados (nombre, cantidad)

                                $table_actual_commands = ComandaTemporal::where('mesa', '=', $mesa->titulo)
                                                            ->where('estado', '=', 'Abierta')
                                                            ->where('status', '=', 'Disponible')
                                                            ->get();

                                $count_actual_commands = ComandaTemporal::where('mesa', '=', $mesa->titulo)
                                                            ->where('estado', '=', 'Abierta')
                                                            ->where('status', '=', 'Disponible')
                                                            ->count();

                                if ($count_actual_commands) {
                                    foreach ($table_actual_commands as $command) {
                                        if ($command->articulo != null) {
                                            $product_data = new stdClass;
                                                $product_data->product_name = $command->articulo;
                                                $product_data->product_quantity = $command->cantidad;
                                                $product_data->product_price = $command->precio_compra;

                                            $column_data->waiter_name = $command?->mesero?->full_name ? $command?->mesero?->full_name : '-- -- --'; // Nombre del Mesero
                                            $column_data->guide_name = $command?->guia?->full_name ? $command?->guia?->full_name : '-- -- --'; // Nombre del Guía
                                            $column_data->subtotal += $command->subtotal; // Total por Consumo
                                            $column_data->food_dishes[] = $product_data; // Productos Solicitados (nombre, cantidad)
                                        }
                                    }
                                }

                            }

                        $response[] = $column_data;
                    }

                    return Response()->json($response);
                }

                return view('HomeViews.jefe_meseros');
            }

            if ($role === 'jefe_cocina') {

                if ($request->ajax()) {

                    $response = [];
                    $mesas = Mesa::orderBy('estado', 'asc')->get();

                    foreach ($mesas as $mesa) {

                        $column_data = new stdClass;
                            $column_data->table_name = $mesa->titulo; // Nombre de la Mesa

                            if($mesa->estado === 'Cerrada') {
                                $column_data->table_status = "Disponible"; // Estado de la Mesa
                                $column_data->waiter_name = "-- -- --"; // Nombre del Mesero
                                $column_data->food_dishes = []; // Productos Solicitados (id, nombre, cantidad, especificaciones, estado)
                            } else {

                                $column_data->table_status = "Ocupada"; // Estado de la Mesa
                                $column_data->waiter_name = "-- -- --"; // Nombre del Mesero
                                $column_data->food_dishes = []; // Productos Solicitados (id, nombre, cantidad, especificaciones, estado)

                                $table_actual_commands = ComandaTemporal::where('mesa', '=', $mesa->titulo)
                                                            ->where('estado', '=', 'Abierta')
                                                            ->where('status', '=', 'Disponible')
                                                            ->orderBy('ready_to_serve', 'asc')
                                                            ->get();

                                $count_actual_commands = ComandaTemporal::where('mesa', '=', $mesa->titulo)
                                                            ->where('estado', '=', 'Abierta')
                                                            ->where('status', '=', 'Disponible')
                                                            ->count();

                                if ($count_actual_commands) {
                                    foreach ($table_actual_commands as $command) {
                                        if ($command->articulo != null) {
                                            $product_data = new stdClass;
                                                $product_data->product_id = $command->id;
                                                $product_data->product_name = $command->articulo;
                                                $product_data->product_quantity = $command->cantidad;
                                                $product_data->product_specifications = $command->preparation_specifications;
                                                $product_data->ready_to_serve = $command->ready_to_serve;

                                            $column_data->waiter_name = $command?->mesero?->full_name ? $command?->mesero?->full_name : '-- -- --'; // Nombre del Mesero
                                            $column_data->food_dishes[] = $product_data; // Productos Solicitados (id, nombre, cantidad, especificaciones, estado)
                                        }
                                    }
                                }

                            }

                        $response[] = $column_data;
                    }

                    return Response()->json($response);
                }

                return view('HomeViews.jefe_cocina');
            }

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
