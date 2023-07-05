<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMailTicket;
use DataTables;
use Validator;
use Mail;

use App\Models\Mesa;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Comanda;
use App\Models\PayMethod;
use App\Models\Orden;
use App\Models\Restaurante;

class OrdenController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::check() && Auth::user()->role == 'desarrollador'){
            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto  = Producto::all();
            $paymethod = PayMethod::all();
            $pedido = Pedido::all();
            $orden = Orden::all();
            $restaurante = Restaurante::all();
            if(request()->ajax()){
                return datatables()->of(Orden::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<a type="button" name="showTicket" id="'.$data->id.'" class="btn btn-success btn-sm" href="/Ordenes/'.$data->id.'">Ver Ticket</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Ordenes.index', compact('orden','mesa','producto',
                'cta','pedido','paymethod','orden','restaurante'));
        }
        if (Auth::check() && Auth::user()->role == 'administrador')
        {
            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto  = Producto::all();
            $paymethod = PayMethod::all();
            $pedido = Pedido::all();
            $orden = Orden::all();
            $restaurante = Restaurante::all();
            if(request()->ajax()){
                return datatables()->of(Orden::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<a type="button" name="showTicket" id="'.$data->id.'" class="btn btn-success btn-sm" href="/Ordenes/'.$data->id.'">Ver Ticket</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('Ordenes.index', compact('orden','mesa','producto',
                'cta','pedido','paymethod','orden','restaurante'));
        }
        if(Auth::check() && Auth::user()->role == 'cajero'){
            $mesa = Mesa::all();
            $cta = CategoriaProducto::all();
            $producto  = Producto::all();
            $paymethod = PayMethod::all();
            $pedido = Pedido::all();
            $orden = Orden::all();
            $restaurante = Restaurante::all();
            if (request()->ajax()) {
                return datatables()->of(Orden::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<a type="button" name="showTicket" id="'.$data->id.'" class="btn btn-success btn-sm" href="/Ordenes/'.$data->id.'">Ver Ticket</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('Ordenes.index', compact('orden','mesa','producto',
                'cta','pedido','paymethod','orden','restaurante'));
        }
        else{
            return view('error');
        }
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
        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono','email','facebook','instagram','twitter','youTube','linkedIn')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            'email'=> $restaurante->email,
            'facebook'=> $restaurante->facebook,
            'instagram'=> $restaurante->instagram,
            'twitter'=> $restaurante->twitter,
            'youTube'=> $restaurante->youTube,
            'linkedIn'=> $restaurante->linkedIn
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>'',
            'email'=> '',
            'facebook'=> '',
            'instagram'=> '',
            'twitter'=> '',
            'youTube'=> '',
            'linkedIn'=> ''
            );
        }
        if(Auth::check() && Auth::user()->role == 'desarrollador'){

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();

            return view('Ordenes.show',['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);
        }
        if (Auth::check() && Auth::user()->role == 'administrador')
        {

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();

            return view('Ordenes.show',['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);
        }
        if(Auth::check() && Auth::user()->role == 'cajero'){

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();

            return view('Ordenes.show',['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);
        }
        else{
            return view('error');
        }
    }

    public function mostrar()
    {
        //tituloMesa
         //$id=DB::table('orden')->all()->last()->id;
         $id=Orden::all()->last()->id;
         $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono','email','facebook','instagram','twitter','youTube','linkedIn')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            'email'=> $restaurante->email,
            'facebook'=> $restaurante->facebook,
            'instagram'=> $restaurante->instagram,
            'twitter'=> $restaurante->twitter,
            'youTube'=> $restaurante->youTube,
            'linkedIn'=> $restaurante->linkedIn
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>'',
            'email'=> '',
            'facebook'=> '',
            'instagram'=> '',
            'twitter'=> '',
            'youTube'=> '',
            'linkedIn'=> ''
            );
        }

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
//                    ->join('productos as a', 'a.id', '=', 'd.articulo_id')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();
                    // dd($orden);
            return view('Ordenes.ticket',['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);

    }

    public function edit($id)
    {
          if(request()->ajax()){
            $data = Orden::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function ticketPdf()
    {
         $id=Orden::all()->last()->id;
         $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono','email','facebook','instagram','twitter','youTube','linkedIn')
          ->first();

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            'email'=> $restaurante->email,
            'facebook'=> $restaurante->facebook,
            'instagram'=> $restaurante->instagram,
            'twitter'=> $restaurante->twitter,
            'youTube'=> $restaurante->youTube,
            'linkedIn'=> $restaurante->linkedIn
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>'',
            'email'=> '',
            'facebook'=> '',
            'instagram'=> '',
            'twitter'=> '',
            'youTube'=> '',
            'linkedIn'=> ''
            );
        }

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
//                    ->join('productos as a', 'a.id', '=', 'd.articulo_id')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();

        $pdf = \PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);

        return $pdf->download('ticket.pdf');

        //return view('Ordenes.ticket',['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);

    }

    public function ticketPdfshow(Request $request)
    {
        $id=$request->id;
        $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono','email','facebook','instagram','twitter','youTube','linkedIn')
          ->first();
         $nombre=$restaurante->nombre;
         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            'email'=> $restaurante->email,
            'facebook'=> $restaurante->facebook,
            'instagram'=> $restaurante->instagram,
            'twitter'=> $restaurante->twitter,
            'youTube'=> $restaurante->youTube,
            'linkedIn'=> $restaurante->linkedIn
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>'',
            'email'=> '',
            'facebook'=> '',
            'instagram'=> '',
            'twitter'=> '',
            'youTube'=> '',
            'linkedIn'=> ''
            );
           $nombre='';
        }
        if(Auth::check() && Auth::user()->role == 'desarrollador'){

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
//                    ->join('productos as a', 'a.id', '=', 'd.articulo_id')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();
            $asunto="Su consumo en restaurante: ".$nombre;

            $pdf = \PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);
            $email= $request->email;
            Mail::to($request->email)->send(new SendMailTicket($restaurante,$asunto,$pdf));
        }
        if (Auth::check() && Auth::user()->role == 'administrador')
        {

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
//                    ->join('productos as a', 'a.id', '=', 'd.articulo_id')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();
            $asunto="Su consumo en restaurante: ".$nombre;
            $pdf = \PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);
            $email= $request->email;
            Mail::to($request->email)->send(new SendMailTicket($restaurante,$asunto,$pdf));
        }
        if(Auth::check() && Auth::user()->role == 'cajero'){

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
//                    ->join('productos as a', 'a.id', '=', 'd.articulo_id')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();
            $asunto="Su consumo en restaurante: ".$nombre;
            $pdf = \PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);
            $email= $request->email;
            Mail::to($request->email)->send(new SendMailTicket($restaurante,$asunto,$pdf));
        }
        else{
            return view('error');
        }
    }

    public function enviarTicket(Request $request)
    {

         $id=Orden::all()->last()->id;
         $dato=Restaurante::min('id');
        if($dato != null){
          $restaurante= DB::table('restaurante')
          ->select('id','nombre','rfc','direccion','telefono','email','facebook','instagram','twitter','youTube','linkedIn')
          ->first();
         $nombre=$restaurante->nombre;

         $restaurante = array(
            'id'=>$restaurante->id,
            'nombre' =>$restaurante->nombre,
            'rfc' => $restaurante->rfc,
            'direccion' => $restaurante->direccion,
            'telefono'=> $restaurante->telefono,
            'email'=> $restaurante->email,
            'facebook'=> $restaurante->facebook,
            'instagram'=> $restaurante->instagram,
            'twitter'=> $restaurante->twitter,
            'youTube'=> $restaurante->youTube,
            'linkedIn'=> $restaurante->linkedIn
            );

        }else{
           $restaurante = array(
            'id'=>0,
            'nombre' => '',
            'rfc' => '',
            'direccion' => '',
            'telefono'=>'',
            'email'=> '',
            'facebook'=> '',
            'instagram'=> '',
            'twitter'=> '',
            'youTube'=> '',
            'linkedIn'=> ''
            );
           $nombre='';
        }

            $producto = Producto::all();
            $orden = DB::table('orden as o')
                ->join('comanda as c' , 'c.pedido_id', '=' , 'o.id')
                ->select('o.id','o.fecha','o.mesa','o.cajero','o.forma_pago','o.cliente','o.direccion','o.conf_total','o.descuento','o.propina','o.total','o.total2','o.pago','o.cambio','o.created_at')
                ->where('o.id' ,'=', $id)
                ->first();

            $pedido = DB::table('comanda as d')
//                    ->join('productos as a', 'a.id', '=', 'd.articulo_id')
                    ->select('d.articulo','d.cantidad', 'd.precio_compra', 'd.subtotal')
                    ->where('d.pedido_id', '=', $id)
                    ->get();

            $detalle = DB::table('comandaesp as x')
                     ->select('x.producto','x.cant','x.precio_c','x.sub_total')
                     ->where('x.pedido_id', '=', $id)
                     ->get();
        $asunto="Su consumo en restaurante: ".$nombre;

        $pdf = \PDF::loadView('Ordenes.ticketPdf', ['orden' => $orden,'pedido' => $pedido,'producto' => $producto,'detalle' => $detalle , 'restaurante' => $restaurante]);

        $email= $request->email;
        Mail::to($request->email)->send(new SendMailTicket($restaurante,$asunto,$pdf));
        //return $pdf->download('ticket.pdf');
    }

    public function invoice()
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('Ordenes.invoice', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('invoice.pdf');
        //return $pdf->stream('invoice');
    }
    public function getData()
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = Orden::findOrFail($id);
        $data->delete();
        return redirect()->route('Ordenes.index')->with('success','Reserva eliminada exitosamente.');
    }
}
