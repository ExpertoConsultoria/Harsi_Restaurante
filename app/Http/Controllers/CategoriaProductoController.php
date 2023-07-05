<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use DataTables;

class CategoriaProductoController extends Controller
{
    public function index()
    {
        $categoria = CategoriaProducto::all();
        if(request()->ajax()){
            return datatables()->of(CategoriaProducto::latest()->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-ms">Editar</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('CategoriaProducto.index', compact('categoria'));

    }
    public function byProducto($id)
    {
        return Producto::where('category_id', $id)->get();
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $form_data = array(
            'titulo' => $request->titulo
        );
        CategoriaProducto::create($form_data);
        return response()->json(['success' => 'Exito']);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $data = CategoriaProducto::findOrFail($id);
        return response()->json(['data' => $data]);
    }
    public function update(Request $request)
    {
        $form_data = array(
            'titulo' => $request->titulo
        );
        CategoriaProducto::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', 'Bien Hecho']);
    }
    public function destroy($id)
    {
        $data = CategoriaProducto::findOrFail($id);
        $data->delete();
    }
}
