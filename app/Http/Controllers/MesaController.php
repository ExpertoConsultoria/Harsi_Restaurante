<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;
use DataTables;

class MesaController extends Controller
{
    public function index()
    {
        $mesa = Mesa::all();
        if(request()->ajax()){
            return datatables()->of(Mesa::latest()->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'"class="edit btn btn-primary btn-sm" >Editar</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("Mesa.index", compact('mesa'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
         $form_data = array(
            'titulo' => $request->titulo,
            'estado' => $request->estado,
            'color' =>  $request->color
        );

        Mesa::create($form_data);

        return response()->json(['success' => 'Exito' ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        if(request()->ajax()){
            $data = Mesa::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }
    public function update(Request $request)
    {
        $form_data = array(
            'titulo' => $request->titulo,
            'estado' => $request->estado,
            'color' => $request->color
        );

        Mesa::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', ' Bien Hecho']);
    }
    public function destroy($id)
    {
        $data = Mesa::findOrFail($id);
        $data->delete();
    }
}
