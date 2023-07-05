<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Estado;

class EstadoController extends Controller
{
    public function index()
    {

        $estado = Estado::all();
            if(request()->ajax()){
                return datatables()->of(Estado::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Estado.index', compact('estado'));
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
        Estado::Create($form_data);
        return response()->json(['success' => 'Registado con exito']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $data = Estado::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $form_data = array(
            'titulo' => $request->titulo
        );
        Estado::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', ' Bien Hecho']);
    }

    public function destroy($id)
    {
        $data = Estado::findOrFail($id);
        $data->delete();
    }
}
