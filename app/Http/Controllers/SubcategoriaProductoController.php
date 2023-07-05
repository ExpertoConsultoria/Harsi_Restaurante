<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;

use App\Models\SubcategoriaProducto;
use App\Models\CategoriaProducto;
use App\Models\Restaurante;
use App\Models\Producto;

class SubcategoriaProductoController extends Controller
{
    public function index()
    {

        $isActivated = Restaurante::select('subcategoria')->orderBy('id', 'desc')->first();

        $subcategoria = \DB::table('subcategorias as s')
            ->join('categorias as c', 's.category_id', '=', 'c.id')
            ->select('s.id','s.titulo','s.created_at','s.updated_at','c.titulo as categoria')
            ->get();

        $categoria = CategoriaProducto::all();
        if(request()->ajax()){
            return datatables()->of($subcategoria)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-ms">Editar</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('SubcategoriaProducto.index', compact('subcategoria','categoria', 'isActivated'));

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
       // print_r($request);
        //dd($request);
        $form_data = array(
            'titulo' => $request->titulo,
            'category_id' => $request->category_id
        );
        SubcategoriaProducto::create($form_data);
        return response()->json(['success' => 'Exito']);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $data = SubcategoriaProducto::findOrFail($id);
        return response()->json(['data' => $data]);
    }
    public function update(Request $request)
    {
        $form_data = array(
            'titulo' => $request->titulo,
            'category_id' => $request->category_id
        );
        SubcategoriaProducto::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', 'Bien Hecho']);
    }
    public function destroy($id)
    {
        $data = SubcategoriaProducto::findOrFail($id);
        $data->delete();
    }
}
