<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Turno extends Controller
{
    public function index() {

        if (Auth::check() && Auth::user()->role == 'administrador') {
            $horario = Horario::all();

            if (request()->ajax()) {
                return datatables()->of(Horario::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '"class="edit btn btn-primary btn-sm" >Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('Horario.index', compact('horario'));
        }

        if (Auth::check() && Auth::user()->role == 'cajero') {

            $horario = Horario::all();

            if (request()->ajax()) {
                return datatables()->of(Horario::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '"class="edit btn btn-primary btn-sm" >Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('Horario.index', compact('horario'));
        } else {
            return view('error');
        }
    }

    public function store(Request $request) {

        $form_data = array(
            'turno' => $request->turno,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->fecha_fin,
        );

        Horario::create($form_data);

        return response()->json(['success' => 'Exito']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $data = Horario::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request) {
        $form_data = array(
            'turno' => $request->turno,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->fecha_fin,
        );

        Horario::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', ' Bien Hecho']);
    }

    public function destroy($id) {
        $data = Horario::findOrFail($id);
        $data->delete();
    }
}
