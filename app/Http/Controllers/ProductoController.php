<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Producto;
use App\Models\Restaurante;
use App\Models\SubcategoriaProducto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index() {

        if (Auth::user()->role !== 'administrador') {
            return view('error');
        }

        $producto = Producto::all();
        $categorias = CategoriaProducto::all();
        $restaurante = Restaurante::first();

        if (request()->ajax()) {
            return datatables()->of(Producto::latest()->get())
                ->addColumn('title', function ($producto) {
                    return $producto->CategoriaProducto->titulo;
                })
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('producto.index', compact('producto', 'categorias', 'restaurante'));

    }

    public function subcategorias(Request $request, $id_categoria) {
        if ($request->ajax()) {
            $subcategorias = SubcategoriaProducto::select('id', 'titulo')
                ->where('category_id', $id_categoria)
                ->get();
            return Response()->json($subcategorias);
        }
    }

    public function byProducto($id) {
        return DB::table('productos as p')
            ->select('p.id', 'p.titulo', 'p.precio')
            ->where('p.id', '=', $id)
            ->get();
    }

    public function byName($name) {
        return Producto::where('titulo', 'LIKE', '%' . $name . '%')->get();
    }

    public function byPrice($id){
        return Producto::where('id', $id)->get();
    }

    public function store(Request $request) {

        if ($request->rsubcategoria != 'No') {
            $form_data = array(
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'titulo' => $request->titulo,
                'precio' => $request->precio,
            );
        } else {
            $form_data = array(
                'category_id' => $request->category_id,
                'titulo' => $request->titulo,
                'precio' => $request->precio,
            );
        }

        Producto::create($form_data);
        return response()->json(['success' => 'Registro con exito']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $data = Producto::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request) {

        if ($request->rsubcategoria != 'No') {
            $form_data = array(
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'titulo' => $request->titulo,
                'precio' => $request->precio,
            );
        } else {
            $form_data = array(
                'category_id' => $request->category_id,
                'titulo' => $request->titulo,
                'precio' => $request->precio,
            );
        }

        Producto::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success', ' Bien Hecho']);
    }

    public function destroy($id) {
        $data = Producto::findOrFail($id);
        $data->delete();
    }
}
