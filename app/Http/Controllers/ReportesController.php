<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Comanda;
use App\Models\ComandaTemporal;
use App\Models\Guia;
use App\Models\Orden;
use App\Models\OrdenCancelado;
use App\Models\Producto;
use App\Models\Restaurante;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function index() {
        // Obtener fechas mínimas y máximas de las órdenes
        // $fechaMinOrden = Orden::min('id'); // Para pruebas locales
        $fechaMinOrden = Orden::min('fecha'); // Para producción

        $fechaMaxOrden = Orden::max('fecha');

        $anioMin = $fechaMinOrden ? Carbon::parse($fechaMinOrden)->year : null;
        $anioMax = $fechaMaxOrden ? Carbon::parse($fechaMaxOrden)->subYear()->year : null;

        // Inicializar las variables que se retornarán
        $aniosDisponibles = [];
        $rangoAnios = [];
        $aniosGuias = [];

        if ($fechaMinOrden && $anioMin > $anioMax) {
            $anioInicio = Carbon::parse(Orden::min('fecha'))->year;
            $anioFinal = Carbon::parse(Orden::max('fecha'))->subYear()->year;

            $aniosDisponibles = range($anioInicio, $anioFinal);
        } else {
            $aniosDisponibles[] = date('Y');
        }

        if ($fechaMinOrden) {
            $anioInicio = Carbon::parse(Orden::min('fecha'))->year;
            $anioFinal = Carbon::parse(Orden::max('fecha'))->year;

            $rangoAnios = $aniosGuias = range($anioInicio, $anioFinal);
        } else {
            $rangoAnios = $aniosGuias = ['No hay registros'];
        }

        // Obtener usuarios y guías
        $usuarios = User::all();
        $guias = Guia::all();

        return view('Reportes.index', compact('usuarios', 'guias', 'aniosDisponibles', 'rangoAnios', 'aniosGuias'));
    }

    public function obtenerMeses($estado) {

        $hoy = Carbon::today();
        $hoya = $hoy->year;
        $hoym = $hoy->month;

        if ($estado == $hoya) {

            if ($hoym > 1) {
                for ($i = 1; $i < $hoym; $i++) {
                    if ($i == 1) {
                        $meses[] = ['id' => $i, 'mes' => 'Enero'];
                    } else if ($i == 2) {
                        $meses[] = ['id' => $i, 'mes' => 'Febrero'];
                    } else if ($i == 3) {
                        $meses[] = ['id' => $i, 'mes' => 'Marzo'];
                    } else if ($i == 4) {
                        $meses[] = ['id' => $i, 'mes' => 'Abril'];
                    } else if ($i == 5) {
                        $meses[] = ['id' => $i, 'mes' => 'Mayo'];
                    } else if ($i == 6) {
                        $meses[] = ['id' => $i, 'mes' => 'Junio'];
                    } else if ($i == 7) {
                        $meses[] = ['id' => $i, 'mes' => 'Julio'];
                    } else if ($i == 8) {
                        $meses[] = ['id' => $i, 'mes' => 'Agosto'];
                    } else if ($i == 9) {
                        $meses[] = ['id' => $i, 'mes' => 'Septiembre'];
                    } else if ($i == 10) {
                        $meses[] = ['id' => $i, 'mes' => 'Octubre'];
                    } else if ($i == 11) {
                        $meses[] = ['id' => $i, 'mes' => 'Noviembre'];
                    } else if ($i == 12) {
                        $meses[] = ['id' => $i, 'mes' => 'Diciembre'];
                    }
                }
                return response()->json($meses);
            } else {
                $meses[] = ['id' => 0, 'mes' => 'El mes actual no esta disponible'];
                return response()->json($meses);
            }

        } else {
            for ($i = 1; $i <= 12; $i++) {
                if ($i == 1) {
                    $meses[] = ['id' => $i, 'mes' => 'Enero'];
                } else if ($i == 2) {
                    $meses[] = ['id' => $i, 'mes' => 'Febrero'];
                } else if ($i == 3) {
                    $meses[] = ['id' => $i, 'mes' => 'Marzo'];
                } else if ($i == 4) {
                    $meses[] = ['id' => $i, 'mes' => 'Abril'];
                } else if ($i == 5) {
                    $meses[] = ['id' => $i, 'mes' => 'Mayo'];
                } else if ($i == 6) {
                    $meses[] = ['id' => $i, 'mes' => 'Junio'];
                } else if ($i == 7) {
                    $meses[] = ['id' => $i, 'mes' => 'Julio'];
                } else if ($i == 8) {
                    $meses[] = ['id' => $i, 'mes' => 'Agosto'];
                } else if ($i == 9) {
                    $meses[] = ['id' => $i, 'mes' => 'Septiembre'];
                } else if ($i == 10) {
                    $meses[] = ['id' => $i, 'mes' => 'Octubre'];
                } else if ($i == 11) {
                    $meses[] = ['id' => $i, 'mes' => 'Noviembre'];
                } else if ($i == 12) {
                    $meses[] = ['id' => $i, 'mes' => 'Diciembre'];
                }
            }
            return response()->json($meses);
        }
    }

    public function obtenerMesesEliminados($estado) {

        $hoy = Carbon::today();
        $hoya = $hoy->year;
        $hoym = $hoy->month;

        if ($estado == $hoya) {
            for ($i = 1; $i <= $hoym; $i++) {
                if ($i == 1) {
                    $meses[] = ['id' => $i, 'mes' => 'Enero'];
                } else if ($i == 2) {
                    $meses[] = ['id' => $i, 'mes' => 'Febrero'];
                } else if ($i == 3) {
                    $meses[] = ['id' => $i, 'mes' => 'Marzo'];
                } else if ($i == 4) {
                    $meses[] = ['id' => $i, 'mes' => 'Abril'];
                } else if ($i == 5) {
                    $meses[] = ['id' => $i, 'mes' => 'Mayo'];
                } else if ($i == 6) {
                    $meses[] = ['id' => $i, 'mes' => 'Junio'];
                } else if ($i == 7) {
                    $meses[] = ['id' => $i, 'mes' => 'Julio'];
                } else if ($i == 8) {
                    $meses[] = ['id' => $i, 'mes' => 'Agosto'];
                } else if ($i == 9) {
                    $meses[] = ['id' => $i, 'mes' => 'Septiembre'];
                } else if ($i == 10) {
                    $meses[] = ['id' => $i, 'mes' => 'Octubre'];
                } else if ($i == 11) {
                    $meses[] = ['id' => $i, 'mes' => 'Noviembre'];
                } else if ($i == 12) {
                    $meses[] = ['id' => $i, 'mes' => 'Diciembre'];
                }
            }
            return response()->json($meses);
        } else {
            for ($i = 1; $i <= 12; $i++) {
                if ($i == 1) {
                    $meses[] = ['id' => $i, 'mes' => 'Enero'];
                } else if ($i == 2) {
                    $meses[] = ['id' => $i, 'mes' => 'Febrero'];
                } else if ($i == 3) {
                    $meses[] = ['id' => $i, 'mes' => 'Marzo'];
                } else if ($i == 4) {
                    $meses[] = ['id' => $i, 'mes' => 'Abril'];
                } else if ($i == 5) {
                    $meses[] = ['id' => $i, 'mes' => 'Mayo'];
                } else if ($i == 6) {
                    $meses[] = ['id' => $i, 'mes' => 'Junio'];
                } else if ($i == 7) {
                    $meses[] = ['id' => $i, 'mes' => 'Julio'];
                } else if ($i == 8) {
                    $meses[] = ['id' => $i, 'mes' => 'Agosto'];
                } else if ($i == 9) {
                    $meses[] = ['id' => $i, 'mes' => 'Septiembre'];
                } else if ($i == 10) {
                    $meses[] = ['id' => $i, 'mes' => 'Octubre'];
                } else if ($i == 11) {
                    $meses[] = ['id' => $i, 'mes' => 'Noviembre'];
                } else if ($i == 12) {
                    $meses[] = ['id' => $i, 'mes' => 'Diciembre'];
                }
            }
            return response()->json($meses);
        }
    }

    public function listaUsuarios() {

        $user = User::all();
        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = Restaurante::select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();
            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        return view('pdf.user', compact('user', 'restaurante'));
    }

    public function listaCategorias() {

        $cta = CategoriaProducto::all();

        $dato = Restaurante::min('id');
        if ($dato != null) {
            $restaurante = Restaurante::select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }
        return view('pdf.categoria', compact('cta', 'restaurante'));
    }

    public function listaProductos() {

        $productos = Producto::select('titulo', 'precio', 'created_at')->get();
        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = Restaurante::select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }
        return view('pdf.producto', compact('productos', 'restaurante'));
    }

    public function lista($estado) {

        if ($estado == 1) {
            $productos = Producto::select('titulo', 'precio', 'created_at')->get();
            $dato = Restaurante::min('id');

            if ($dato != null) {
                $restaurante = Restaurante::select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                    ->first();

                $restaurante = array(
                    'id' => $restaurante->id,
                    'nombre' => $restaurante->nombre,
                    'rfc' => $restaurante->rfc,
                    'direccion' => $restaurante->direccion,
                    'telefono' => $restaurante->telefono,
                );

            } else {
                $restaurante = array(
                    'id' => 0,
                    'nombre' => '',
                    'rfc' => '',
                    'direccion' => '',
                    'telefono' => '',
                );
            }
            return view('pdf.producto', compact('productos', 'restaurante'));

        } elseif ($estado == 2) {

            $cta = CategoriaProducto::all();
            $dato = Restaurante::min('id');

            if ($dato != null) {
                $restaurante = Restaurante::select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                    ->first();

                $restaurante = array(
                    'id' => $restaurante->id,
                    'nombre' => $restaurante->nombre,
                    'rfc' => $restaurante->rfc,
                    'direccion' => $restaurante->direccion,
                    'telefono' => $restaurante->telefono,
                );

            } else {
                $restaurante = array(
                    'id' => 0,
                    'nombre' => '',
                    'rfc' => '',
                    'direccion' => '',
                    'telefono' => '',
                );
            }
            return view('pdf.categoria', compact('cta', 'restaurante'));

        } elseif ($estado == 3) {
            $user = User::all();
            $dato = Restaurante::min('id');

            if ($dato != null) {
                $restaurante = Restaurante::select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                    ->first();

                $restaurante = array(
                    'id' => $restaurante->id,
                    'nombre' => $restaurante->nombre,
                    'rfc' => $restaurante->rfc,
                    'direccion' => $restaurante->direccion,
                    'telefono' => $restaurante->telefono,
                );

            } else {
                $restaurante = array(
                    'id' => 0,
                    'nombre' => '',
                    'rfc' => '',
                    'direccion' => '',
                    'telefono' => '',
                );
            }

            return view('pdf.user', compact('user', 'restaurante'));
        }

    }

    public function listaVentas($estado) {

        $orden = DB::table('orden')
            ->select(DB::raw("COUNT(*) AS contador, MONTH(fecha) AS mes, SUM(total) as total, YEAR(fecha) AS anno, SUM(descuento_pesos) as descuento, SUM(propina) as propina "))
            ->whereYear('fecha', $estado)
            ->groupBy(DB::raw("YEAR(fecha),MONTH(fecha)"))
            ->groupBy(DB::raw("YEAR(fecha),MONTH(fecha)", "ASC"))
            ->get();

        $total = Orden::whereYear('fecha', $estado)->sum('total');
        $descuento = Orden::whereYear('fecha', $estado)->sum('descuento_pesos');
        $propina = Orden::whereYear('fecha', $estado)->sum('propina');

        $dato = Restaurante::min('id');
        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }
        return view('pdf.ventas', compact('orden', 'total', 'propina', 'descuento', 'restaurante', 'estado'));
    }

    public function reporteDiario($estado, $fecha) {
        $fecha = Carbon::parse($fecha);
        $restaurante = Restaurante::first();
        $turno = Auth::check() ? Auth::user()->turno : null;
        $cajero = Auth::check() ? Auth::user()->name : null;

        // Consulta base común
        $baseQuery = Orden::whereDay('fecha', $fecha)
            ->whereMonth('fecha', $fecha)
            ->whereYear('fecha', $fecha);

        // Filtra según estado
        $baseQuery = $this->filtrarPorEstado($baseQuery, $estado);

        // Si el usuario es cajero, agrega filtros adicionales
        if (Auth::check() && Auth::user()->role == 'cajero') {
            $baseQuery->where('turno', $turno)->where('cajero', $cajero);
        }

        // Obtén las órdenes y cálculos requeridos
        $orden = $baseQuery->get();
        $importe = $baseQuery->sum('conf_total');
        $descuento = $baseQuery->sum('descuento_pesos');
        $total = $baseQuery->sum('total');
        $propina = $baseQuery->sum('propina');
        $total2 = $baseQuery->sum('total2');
        $ordenc = $estado == 1 && Auth::check() && in_array(Auth::user()->role, ['administrador', 'jefe_meseros']) ? Comanda::all() : [];

        return view('pdf.reporteDiario', compact(
            'orden', 'importe', 'total', 'propina', 'total2', 'descuento',
            'restaurante', 'ordenc', 'estado', 'fecha'
        ));
    }

    // Función auxiliar para filtrar las órdenes según el estado
    private function filtrarPorEstado($query, $estado) {
        switch ($estado) {
            case 1:
                return $query->where('mesa', 'Para llevar');
            case 2:
                return $query->whereIn('mesa', ['Uber', 'Rappi', 'Diddi']);
            case 3:
                return $query->whereNotIn('mesa', ['Para llevar', 'Uber', 'Rappi', 'Diddi']);
            case 4:
            default:
                return $query;
        }
    }

    public function reporteMensual($estado, $meses) {

        $orden = DB::table('orden')
            ->select(DB::raw("COUNT(*) AS contador,fecha, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(total) as total,YEAR(fecha) AS anno, SUM(descuento_pesos) as descuento, SUM(propina) as propina"))
            ->whereMonth('fecha', $meses)
            ->whereYear('fecha', $estado)
            ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
            ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)", "ASC"))
            ->get();

        $total = Orden::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('total');
        $descuento = Orden::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('descuento_pesos');
        $propina = Orden::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('propina');

        $dato = Restaurante::min('id');
        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        $month = Carbon::create(2000, $meses, 1)->locale('es')->monthName;
        $month = ucfirst($month);

        return view('pdf.reporteMensual', compact('orden', 'total', 'propina', 'descuento', 'restaurante', 'month'));
    }

    public function reporteEliminados($estado, $meses) {
        $orden = DB::table('comanda_temporal')
            ->select(DB::raw("COUNT(*) AS contador,fecha, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(subtotal) as total,YEAR(fecha) AS anno"))
            ->whereMonth('fecha', $meses)
            ->whereYear('fecha', $estado)
            ->where('status', 'Eliminado')
            ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
            ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)", "ASC"))
            ->get();

        $total = ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->sum('subtotal');
        $eliminado = ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->count();

        $dato = Restaurante::min('id');
        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        return view('pdf.reporteEliminados', compact('orden', 'total', 'eliminado', 'restaurante'));
    }

    public function reporteDiarioEliminados($estado) {

        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        if ($estado == 1) {
            $temporal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', 'Para llevar')->where('status', 'Eliminado')->get();
            $cantidad = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', 'Para llevar')->where('status', 'Eliminado')->sum('cantidad');
            $precio_compra = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', 'Para llevar')->where('status', 'Eliminado')->sum('precio_compra');
            $subtotal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', 'Para llevar')->where('status', 'Eliminado')->sum('subtotal');

            return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante'));

        } elseif ($estado == 2) {

            $temporal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->get();
            $cantidad = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('cantidad');
            $precio_compra = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('precio_compra');
            $subtotal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('subtotal');

            return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante'));

        } elseif ($estado == 3) {
            $temporal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->get();
            $cantidad = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('cantidad');
            $precio_compra = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('precio_compra');
            $subtotal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('subtotal');

            return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante'));
        } elseif ($estado == 4) {
            $temporal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->get();
            $cantidad = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->sum('cantidad');
            $precio_compra = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->sum('precio_compra');
            $subtotal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status', 'Eliminado')->sum('subtotal');

            return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante'));
        }

    }

    public function reporteMesasEliminados($estado, $meses) {

        $orden = DB::table('orden_cancelado')
            ->select(DB::raw("COUNT(*) AS contador,fecha,motivo, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(total) as total,YEAR(fecha) AS anno"))
            ->whereMonth('fecha', $meses)
            ->whereYear('fecha', $estado)
            ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
            ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)", "ASC"))
            ->get();

        $total = OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('total');
        $eliminado = OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->count();
        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        return view('pdf.reporteMesasEliminadas', compact('orden', 'total', 'eliminado', 'restaurante'));
    }

    public function reporteMesasDiarioEliminados($estado) {

        $dato = Restaurante::min('id');
        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        if ($estado == 1) {
            $mesas = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', 'Para llevar')->get();
            $total = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', 'Para llevar')->sum('total');

            return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante'));

        } elseif ($estado == 2) {

            $mesas = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->get();
            $total = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('total');

            return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante'));

        } elseif ($estado == 3) {
            $mesas = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->get();
            $total = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('total');

            return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante'));
        } elseif ($estado == 4) {
            $mesas = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->get();
            $total = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->sum('total');

            return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante'));
        }

    }

    public function incidenciasDiarias($estado, $tipo, $fecha) {

        $fecha1 = Carbon::parse($fecha);
        $dato = Restaurante::min('id');

        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        if ($tipo == 1) {
            if ($estado == 1) {
                $mesas = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', 'Para llevar')->get();
                $total = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', 'Para llevar')->sum('total');

                return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante', 'fecha'));

            } elseif ($estado == 2) {

                $mesas = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->get();
                $total = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('total');

                return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante', 'fecha'));

            } elseif ($estado == 3) {
                $mesas = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->get();
                $total = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('total');

                return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante', 'fecha'));
            } elseif ($estado == 4) {
                $mesas = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->get();
                $total = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');

                return view('pdf.reporteMesasEliminadosDiario', compact('mesas', 'total', 'restaurante', 'fecha'));
            }

        } else {

            if ($estado == 1) {
                $temporal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', 'Para llevar')->where('status', 'Eliminado')->get();
                $cantidad = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', 'Para llevar')->where('status', 'Eliminado')->sum('cantidad');
                $precio_compra = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', 'Para llevar')->where('status', 'Eliminado')->sum('precio_compra');
                $subtotal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa', 'Para llevar')->where('status', 'Eliminado')->sum('subtotal');

                return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante', 'fecha'));

            } elseif ($estado == 2) {

                $temporal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->get();
                $cantidad = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('cantidad');
                $precio_compra = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('precio_compra');
                $subtotal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where(function ($query) {$query->where('mesa', '=', 'Uber')->orWhere('mesa', '=', 'Rappi')->orWhere('mesa', '=', 'Diddi');})->sum('subtotal');

                return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante', 'fecha'));

            } elseif ($estado == 3) {
                $temporal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->get();
                $cantidad = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('cantidad');
                $precio_compra = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('precio_compra');
                $subtotal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->where('mesa', '!=', 'Para llevar')->where('mesa', '!=', 'Uber')->where('mesa', '!=', 'Rappi')->where('mesa', '!=', 'Diddi')->sum('subtotal');

                return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante', 'fecha'));
            } elseif ($estado == 4) {
                $temporal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->get();
                //dd($temporal);
                $cantidad = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->sum('cantidad');
                $precio_compra = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->sum('precio_compra');
                $subtotal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status', 'Eliminado')->sum('subtotal');

                return view('pdf.reporteEliminadosDiario', compact('temporal', 'cantidad', 'precio_compra', 'subtotal', 'restaurante', 'fecha'));
            }
        }

    }

    public function incidenciasMensuales($estado, $tipo, $meses) {

        $dato = Restaurante::min('id');
        $month = Carbon::create(2000, $meses, 1)->locale('es')->monthName;
        $month = ucfirst($month);

        if ($dato != null) {
            $restaurante = DB::table('restaurante')
                ->select('id', 'nombre', 'rfc', 'direccion', 'telefono')
                ->first();

            $restaurante = array(
                'id' => $restaurante->id,
                'nombre' => $restaurante->nombre,
                'rfc' => $restaurante->rfc,
                'direccion' => $restaurante->direccion,
                'telefono' => $restaurante->telefono,
            );

        } else {
            $restaurante = array(
                'id' => 0,
                'nombre' => '',
                'rfc' => '',
                'direccion' => '',
                'telefono' => '',
            );
        }

        if ($tipo == 1) {
            $orden = DB::table('orden_cancelado')
                ->select(DB::raw("COUNT(*) AS contador,fecha,motivo, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(total) as total,YEAR(fecha) AS anno"))
                ->whereMonth('fecha', $meses)
                ->whereYear('fecha', $estado)
                ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
                ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)", "ASC"))
                ->groupBy(DB::raw("motivo"))
                ->get();

            $total = OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('total');
            $eliminado = OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->count();

            return view('pdf.reporteMesasEliminadas', compact('orden', 'total', 'eliminado', 'restaurante', 'month'));

        } else {

            $orden = DB::table('comanda_temporal')
                ->select(DB::raw("COUNT(*) AS contador,fecha,motivo, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(subtotal) as total,YEAR(fecha) AS anno"))
                ->whereMonth('fecha', $meses)
                ->whereYear('fecha', $estado)
                ->where('status', 'Eliminado')
                ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
                ->groupBy(DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)", "ASC"))
                ->groupBy(DB::raw("motivo"))
                ->get();

            $total = ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->sum('subtotal');
            $eliminado = ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->count();

            return view('pdf.reporteEliminados', compact('orden', 'total', 'eliminado', 'restaurante', 'month'));
        }

    }

    public function commissionsPerDay ($fecha, $guide_id) {

        $restaurante = Restaurante::first();

        $guia = Guia::findOrFail($guide_id);

        $ordenes = Orden::select('id', 'fecha', 'comision', 'total2', 'propina', 'comision_percentage')
                        ->where('fecha',$fecha)
                        ->where('guia_id',$guide_id)
                        ->get();

        return view('pdf.commissionsPerDay', compact('ordenes', 'fecha', 'guia', 'restaurante'));
    }
}
