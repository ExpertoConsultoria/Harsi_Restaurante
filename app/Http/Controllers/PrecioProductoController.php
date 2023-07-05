<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\PrecioProducto;

use Illuminate\Support\Facades\Auth;
use DataTables;

class PrecioProductoController extends Controller
{
    public function index()
    {
        $producto = Producto::all();
        if(request()->ajax()){
            return datatables()->of(PrecioProducto::with('producto')->latest()->get())
                ->addColumn('title',function($producto){
                    return $producto->Producto->titulo;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'"
                class="edit btn btn-primary btn-sm">Editar</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('PrecioProducto.index', compact('precioproducto','producto'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $form_data = array(
            'product_id' => $request->product_id,
            'precio' => $request->precio
        );

        PrecioProducto::create($form_data);

        return response()->json(['success' => 'Exito' ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        if(request()->ajax()){
            $data = PrecioProducto::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }
    public function update(Request $request)
    {
        $form_data = array(
            'product_id' => $request->product_id,
            'precio' => $request->precio
        );

        PrecioProducto::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', ' Bien Hecho']);
    }
    public function destroy($id)
    {
        $data = PrecioProducto::findOrFail($id);
        $data->delete();
    }
}
