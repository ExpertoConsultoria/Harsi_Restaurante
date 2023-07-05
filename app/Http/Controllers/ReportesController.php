<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mesa;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Comanda;
use App\Models\ComandaEsp;
use App\Models\ComandaTemporal;
use App\Models\PayMethod;
use App\Models\Estado;
use App\Models\Orden;
use App\Models\OrdenCancelado;
use App\Models\Restaurante;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\laravel-dompdf\Facade as PDF;
use Illuminate\Support\Facades\Auth;


class ReportesController extends Controller
{
    public function index()
    {

        $orden1=Orden::min('id');
        $fecha1= Carbon::parse($orden1);
        $fecha1=strtotime($fecha1->year);


        $orden2 = Orden::max('fecha');
        $fecha2= Carbon::parse($orden2);
        $fecha2 = strtotime($fecha2->subYear());

        if($orden1 != null && $fecha1>$fecha2){

        $data1 =Orden::min('fecha');
        $fechai= Carbon::parse($data1);
        $fechai=$fechai->year;

        $data2 = Orden::max('fecha');
        $fechaf= Carbon::parse($data2);
        $fechaf = $fechaf->subYear();
        $fechaf=$fechaf->year;

        for ($i=$fechai; $i <= $fechaf ; $i++) {
            $variable[]=$i;
        }

        }else{
            $variable[]='No hay registros';
        }

        if($orden1 != null){

        $data1 =Orden::min('fecha');
        $fechai= Carbon::parse($data1);
        $fechai=$fechai->year;

        $data3 = Orden::max('fecha');
        $fechafinal= Carbon::parse($data3);
        $fechafinal=$fechafinal->year;

        for ($x=$fechai; $x <= $fechafinal ; $x++) {
         $variable2[]=$x;
         $variable3[]=$x;
        }

        }else{
          $variable2[]='No hay registros';
          $variable3[]='No hay registros';
        }

        $user = User::all();
        return view('Reportes.index',compact('user','variable','variable2','variable3'));
      }

   public function obtenerMeses($estado)
    {

        $hoy = Carbon::today();
        $hoya=$hoy->year;
        $hoym=$hoy->month;

         if($estado==$hoya){
         if($hoym > 1){
          for ($i=1; $i < $hoym; $i++) {
            if($i==1){
            $meses[]=['id'=>$i,'mes'=>'Enero'];
            }
            else if($i==2){
            $meses[]=['id'=>$i,'mes'=>'Febrero'];
            }else if($i==3){
            $meses[]=['id'=>$i,'mes'=>'Marzo'];
            }else if($i==4){
            $meses[]=['id'=>$i,'mes'=>'Abril'];
            }else if($i==5){
            $meses[]=['id'=>$i,'mes'=>'Mayo'];
            }else if($i==6){
            $meses[]=['id'=>$i,'mes'=>'Junio'];
            }else if($i==7){
            $meses[]=['id'=>$i,'mes'=>'Julio'];
            }else if($i==8){
            $meses[]=['id'=>$i,'mes'=>'Agosto'];
            }else if($i==9){
            $meses[]=['id'=>$i,'mes'=>'Septiembre'];
            }else if($i==10){
            $meses[]=['id'=>$i,'mes'=>'Octubre'];
            }else if($i==11){
            $meses[]=['id'=>$i,'mes'=>'Noviembre'];
            }else if($i==12){
            $meses[]=['id'=>$i,'mes'=>'Diciembre'];
            }
          }
           return response()->json($meses);
          }else{
           $meses[]=['id'=>0,'mes'=>'El mes actual no esta disponible'];
           return response()->json($meses);
         }
         }else{
          for ($i=1; $i <= 12 ; $i++) {
            if($i==1){
            $meses[]=['id'=>$i,'mes'=>'Enero'];
            }
            else if($i==2){
            $meses[]=['id'=>$i,'mes'=>'Febrero'];
            }else if($i==3){
            $meses[]=['id'=>$i,'mes'=>'Marzo'];
            }else if($i==4){
            $meses[]=['id'=>$i,'mes'=>'Abril'];
            }else if($i==5){
            $meses[]=['id'=>$i,'mes'=>'Mayo'];
            }else if($i==6){
            $meses[]=['id'=>$i,'mes'=>'Junio'];
            }else if($i==7){
            $meses[]=['id'=>$i,'mes'=>'Julio'];
            }else if($i==8){
            $meses[]=['id'=>$i,'mes'=>'Agosto'];
            }else if($i==9){
            $meses[]=['id'=>$i,'mes'=>'Septiembre'];
            }else if($i==10){
            $meses[]=['id'=>$i,'mes'=>'Octubre'];
            }else if($i==11){
            $meses[]=['id'=>$i,'mes'=>'Noviembre'];
            }else if($i==12){
            $meses[]=['id'=>$i,'mes'=>'Diciembre'];
            }
          }
          return response()->json($meses);
         }
    }

    public function obtenerMesesEliminados($estado)
    {

        $hoy = Carbon::today();
        $hoya=$hoy->year;
        $hoym=$hoy->month;

         if($estado==$hoya){
          for ($i=1; $i <= $hoym; $i++) {
            if($i==1){
            $meses[]=['id'=>$i,'mes'=>'Enero'];
            }
            else if($i==2){
            $meses[]=['id'=>$i,'mes'=>'Febrero'];
            }else if($i==3){
            $meses[]=['id'=>$i,'mes'=>'Marzo'];
            }else if($i==4){
            $meses[]=['id'=>$i,'mes'=>'Abril'];
            }else if($i==5){
            $meses[]=['id'=>$i,'mes'=>'Mayo'];
            }else if($i==6){
            $meses[]=['id'=>$i,'mes'=>'Junio'];
            }else if($i==7){
            $meses[]=['id'=>$i,'mes'=>'Julio'];
            }else if($i==8){
            $meses[]=['id'=>$i,'mes'=>'Agosto'];
            }else if($i==9){
            $meses[]=['id'=>$i,'mes'=>'Septiembre'];
            }else if($i==10){
            $meses[]=['id'=>$i,'mes'=>'Octubre'];
            }else if($i==11){
            $meses[]=['id'=>$i,'mes'=>'Noviembre'];
            }else if($i==12){
            $meses[]=['id'=>$i,'mes'=>'Diciembre'];
            }
          }
           return response()->json($meses);
         }else{
          for ($i=1; $i <= 12 ; $i++) {
            if($i==1){
            $meses[]=['id'=>$i,'mes'=>'Enero'];
            }
            else if($i==2){
            $meses[]=['id'=>$i,'mes'=>'Febrero'];
            }else if($i==3){
            $meses[]=['id'=>$i,'mes'=>'Marzo'];
            }else if($i==4){
            $meses[]=['id'=>$i,'mes'=>'Abril'];
            }else if($i==5){
            $meses[]=['id'=>$i,'mes'=>'Mayo'];
            }else if($i==6){
            $meses[]=['id'=>$i,'mes'=>'Junio'];
            }else if($i==7){
            $meses[]=['id'=>$i,'mes'=>'Julio'];
            }else if($i==8){
            $meses[]=['id'=>$i,'mes'=>'Agosto'];
            }else if($i==9){
            $meses[]=['id'=>$i,'mes'=>'Septiembre'];
            }else if($i==10){
            $meses[]=['id'=>$i,'mes'=>'Octubre'];
            }else if($i==11){
            $meses[]=['id'=>$i,'mes'=>'Noviembre'];
            }else if($i==12){
            $meses[]=['id'=>$i,'mes'=>'Diciembre'];
            }
          }
          return response()->json($meses);
         }
    }

     public function listaUsuarios()
    {
        $user = User::all();

        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

         return view('pdf.user',compact('user','restaurante'));
    }

    public function listaCategorias()
    {
        $cta = CategoriaProducto::all();

        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }
         return view('pdf.categoria',compact('cta','restaurante'));
    }
    public function listaProductos()
    {

        $productos = DB::table('productos as p')
    			->select('p.titulo','p.precio', 'p.created_at')
    			->get();

        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }
         return view('pdf.producto',compact('productos','restaurante'));
    }

    public function lista($estado)
    {
      if($estado==1){
        $productos = DB::table('productos as p')
          ->select('p.titulo','p.precio', 'p.created_at')
          ->get();

        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }
         return view('pdf.producto',compact('productos','restaurante'));

      }elseif ($estado==2) {

        $cta = CategoriaProducto::all();

        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }
         return view('pdf.categoria',compact('cta','restaurante'));

      }elseif ($estado==3) {
        $user = User::all();

        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

         return view('pdf.user',compact('user','restaurante'));
      }

    }

    public function listaVentas($estado)
    {

    $orden= DB::table('orden')
          ->select(\DB::raw("COUNT(*) AS contador, MONTH(fecha) AS mes, SUM(total) as total, YEAR(fecha) AS anno, SUM(descuento_pesos) as descuento, SUM(propina) as propina "))
          ->whereYear('fecha', $estado)
          ->groupBy(\DB::raw("YEAR(fecha),MONTH(fecha)"))
          ->groupBy(\DB::raw("YEAR(fecha),MONTH(fecha)","ASC"))
          ->get();

    $total= Orden::whereYear('fecha', $estado)->sum('total');
    $descuento= Orden::whereYear('fecha', $estado)->sum('descuento_pesos');
    $propina= Orden::whereYear('fecha', $estado)->sum('propina');

        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }
      return view('pdf.ventas',compact('orden','total','propina','descuento','restaurante'));
    }

   public function reporteDiario($estado,$fecha)
    {
       $fecha1= Carbon::parse($fecha);
       $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }
      if(Auth::check() && Auth::user()->role == 'desarrollador'){
       if($estado==1){
        $ordenc= Comanda::all();
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->get();
        $importe = Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha',$fecha1)->where('mesa','Para llevar')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc','estado','fecha'));

      }
      elseif ($estado==2) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));

      }elseif ($estado==3) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));
      }elseif ($estado==4) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));
      }
      }

      if(Auth::check() && Auth::user()->role == 'administrador'){
       if($estado==1){
        $ordenc= Comanda::all();
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->get();
        $importe = Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha',$fecha1)->where('mesa','Para llevar')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc','estado','fecha'));

      }elseif ($estado==2) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));

      }elseif ($estado==3) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total2');

       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));
      }elseif ($estado==4) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));
      }
      }
      if(Auth::check() && Auth::user()->role == 'cajero'){
       if($estado==1){
        $ordenc= Comanda::all();
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe = Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha',$fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc','estado','fecha'));

      }elseif ($estado==2) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));

      }elseif ($estado==3) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');

       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));
      }elseif ($estado==4) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');
        //dd($orden);
       return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','estado','fecha'));
      }
      }

    }

    public function reporteDiarioPdf($estado,$fecha)
    {
       $fecha1= Carbon::parse($fecha);
       $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }
      if(Auth::check() && Auth::user()->role == 'desarrollador'){
       if($estado==1){
        $ordenc= Comanda::all();
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->get();
        $importe = Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha',$fecha1)->where('mesa','Para llevar')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total2');
       //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');
      }
      elseif ($estado==2) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total2');
       //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');

      }elseif ($estado==3) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total2');
       //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
       $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
       return $pdf->download('ventadiario.pdf');

      }elseif ($estado==4) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total2');
        //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');
      }
      }

      if(Auth::check() && Auth::user()->role == 'administrador'){
       if($estado==1){
        $ordenc= Comanda::all();
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->get();
        $importe = Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha',$fecha1)->where('mesa','Para llevar')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total2');
        //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');

      }elseif ($estado==2) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total2');
        //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');

      }elseif ($estado==3) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total2');
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');
       //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
      }elseif ($estado==4) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total2');
        //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');
      }
      }
      if(Auth::check() && Auth::user()->role == 'cajero'){
       if($estado==1){
        $ordenc= Comanda::all();
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe = Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha',$fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');
        //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante','ordenc'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');

      }elseif ($estado==2) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');
        //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');

      }elseif ($estado==3) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');
        //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');

      }elseif ($estado==4) {
        $orden= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->get();
        $importe= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('conf_total');
        $descuento= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('descuento_pesos');
        $total= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');
        $propina= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('propina');
        // $cupon= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('cupon');
        $total2= Orden::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('turno',Auth::user()->turno)->where('cajero',Auth::user()->name)->sum('total2');

        $pdf = \PDF::loadView('pdf.ventadiariopdf',compact('orden','importe','total','propina','total2','descuento','restaurante'))->setPaper('letter','landscape');
        return $pdf->download('ventadiario.pdf');
        //dd($orden);
       //return view('pdf.reporteDiario',compact('orden','importe','total','propina','total2','descuento','restaurante'));
      }
      }

    }

    public function reporteMensual($estado,$meses)
    {
        $orden= DB::table('orden')
          ->select(\DB::raw("COUNT(*) AS contador,fecha, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(total) as total,YEAR(fecha) AS anno, SUM(descuento_pesos) as descuento, SUM(propina) as propina"))
          ->whereMonth('fecha', $meses)
          ->whereYear('fecha', $estado)
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)","ASC"))
          ->get();

    $total= Orden::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('total');
    $descuento= Orden::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('descuento_pesos');
    $propina= Orden::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('propina');
    // $cupon= Orden::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('cupon');

    $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

       return view('pdf.reporteMensual',compact('orden','total','propina','descuento','restaurante'));
    }
       public function reporteEliminados($estado,$meses)
    {
        $orden= DB::table('comanda_temporal')
          ->select(\DB::raw("COUNT(*) AS contador,fecha, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(subtotal) as total,YEAR(fecha) AS anno"))
          ->whereMonth('fecha', $meses)
          ->whereYear('fecha', $estado)
          ->where('status', 'Eliminado')
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)","ASC"))
          ->get();

    $total= ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->sum('subtotal');
    $eliminado= ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->count();

     $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

       return view('pdf.reporteEliminados',compact('orden','total','eliminado','restaurante'));
    }

    public function reporteDiarioEliminados($estado)
    {
      $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

      if($estado==1){
        $temporal= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','Para llevar')->where('status','Eliminado')->get();
        $cantidad = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','Para llevar')->where('status','Eliminado')->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','Para llevar')->where('status','Eliminado')->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','Para llevar')->where('status','Eliminado')->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));

      }elseif ($estado==2) {

        $temporal = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today()) ->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $cantidad = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));

      }elseif ($estado==3) {
        $temporal= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $cantidad = ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));
      }elseif ($estado==4) {
        $temporal= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->get();
        $cantidad= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('status','Eliminado')->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));
      }

    }


        public function reporteMesasEliminados($estado,$meses)
    {
        $orden= DB::table('orden_cancelado')
          ->select(\DB::raw("COUNT(*) AS contador,fecha,motivo, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(total) as total,YEAR(fecha) AS anno"))
          ->whereMonth('fecha', $meses)
          ->whereYear('fecha', $estado)
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)","ASC"))
          ->get();


    $total= OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('total');
    $eliminado= OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->count();

     $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

       return view('pdf.reporteMesasEliminadas',compact('orden','total','eliminado','restaurante'));
    }

       public function reporteMesasDiarioEliminados($estado)
    {
      $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

      if($estado==1){
        $mesas= OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','Para llevar')->get();
        $total= OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','Para llevar')->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));

      }elseif ($estado==2) {

        $mesas = OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $total= OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));

      }elseif ($estado==3) {
        $mesas= OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $total= OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));
      }elseif ($estado==4) {
        $mesas= OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->get();
        $total= OrdenCancelado::whereDay('fecha', Carbon::today())->whereMonth('fecha', Carbon::today())->whereYear('fecha', Carbon::today())->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));
      }

    }

    public function incidenciasDiarias($estado,$tipo,$fecha){


      $fecha1= Carbon::parse($fecha);
      $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

    if($tipo==1){
       if($estado==1){
        $mesas= OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->get();
        $total= OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));

      }elseif ($estado==2) {

        $mesas = OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $total= OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));

      }elseif ($estado==3) {
        $mesas= OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $total= OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));
      }elseif ($estado==4) {
        $mesas= OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->get();
        $total= OrdenCancelado::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->sum('total');

       return view('pdf.reporteMesasEliminadosDiario',compact('mesas','total','restaurante'));
      }

    }else{

       if($estado==1){
        $temporal= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('status','Eliminado')->get();
        $cantidad = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('status','Eliminado')->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('status','Eliminado')->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('mesa','Para llevar')->where('status','Eliminado')->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));

      }elseif ($estado==2) {

        $temporal = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1) ->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->get();
        $cantidad = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->where(function ($query) {$query->where('mesa','=','Uber')->orWhere('mesa','=','Rappi')->orWhere('mesa','=','Diddi');})->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));

      }elseif ($estado==3) {
        $temporal= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->get();
        $cantidad = ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->where('mesa','!=','Para llevar')->where('mesa','!=','Uber')->where('mesa','!=','Rappi')->where('mesa','!=','Diddi')->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));
      }elseif ($estado==4) {
        $temporal= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->get();
        //dd($temporal);
        $cantidad= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->sum('cantidad');
        $precio_compra= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->sum('precio_compra');
        $subtotal= ComandaTemporal::whereDay('fecha', $fecha1)->whereMonth('fecha', $fecha1)->whereYear('fecha', $fecha1)->where('status','Eliminado')->sum('subtotal');

       return view('pdf.reporteEliminadosDiario',compact('temporal','cantidad','precio_compra','subtotal','restaurante'));
      }
    }

    }


 public function incidenciasMensuales($estado,$tipo,$meses){

  $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>''
            );
        }

     if($tipo==1){
     $orden= DB::table('orden_cancelado')
          ->select(\DB::raw("COUNT(*) AS contador,fecha,motivo, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(total) as total,YEAR(fecha) AS anno"))
          ->whereMonth('fecha', $meses)
          ->whereYear('fecha', $estado)
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)","ASC"))
          ->groupBy(\DB::raw("motivo"))
          ->get();

    $total= OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->sum('total');
    $eliminado= OrdenCancelado::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->count();

    return view('pdf.reporteMesasEliminadas',compact('orden','total','eliminado','restaurante'));

     }else{

      $orden= DB::table('comanda_temporal')
          ->select(\DB::raw("COUNT(*) AS contador,fecha,motivo, DAY(fecha) AS dia, MONTH(fecha) AS mes,SUM(subtotal) as total,YEAR(fecha) AS anno"))
          ->whereMonth('fecha', $meses)
          ->whereYear('fecha', $estado)
          ->where('status', 'Eliminado')
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)"))
          ->groupBy(\DB::raw("fecha,DAY(fecha),YEAR(fecha),MONTH(fecha)","ASC"))
          ->groupBy(\DB::raw("motivo"))
          ->get();

    $total= ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->sum('subtotal');
    $eliminado= ComandaTemporal::whereMonth('fecha', $meses)->whereYear('fecha', $estado)->where('status', 'Eliminado')->count();

    return view('pdf.reporteEliminados',compact('orden','total','eliminado','restaurante'));

     }

 }



    public function listaVentasDiarias()
    {
      $diario = DB::select('
        SELECT id AS Folio,
        fecha AS FECHA,
        forma_pago AS PAGO,
        mesa AS MESA,
        SUM(total) AS TOTAL_VENTA
        FROM orden
        GROUP BY id
        ORDER BY fecha ASC;');
        return view('pdf.diario',compact('diario'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

