<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Mesa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index() {
        if (!Auth::check()) {
            return view('error');
        }

        $userRole = Auth::user()->role;
        $calendar = Calendar::all();
        $mesas = Mesa::select('titulo')
                        ->where(function ($query) {
                            $query->where('titulo', 'not like', '%Didi%')
                                ->where('titulo', 'not like', '%Para llevar%')
                                ->where('titulo', 'not like', '%Rappi%')
                                ->where('titulo', 'not like', '%Uber%');
                        })
                        ->get();


        if (request()->ajax()) {
            $datatable = datatables()->of(Calendar::latest()->get())
                ->addColumn('action', function ($data) use ($userRole) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Editar</button>';
                    if ($userRole === 'administrador') {
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

            return $datatable;
        }

        return view('Calendar.index', compact('calendar', 'mesas'));
    }

    public function store(Request $request) {

        $form_data = array(
            'titulo' => $request->titulo,
            'personas' => $request->personas,
            'fecha' => $request->fecha_ini,
            'mesas' => $request->mesas,
            'color' => $request->color,
            'detalles' => $request->detalles,
        );

        Calendar::create($form_data);

        return response()->json(['success' => 'Exito']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $data = Calendar::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request) {
        $form_data = array(
            'titulo' => $request->titulo,
            'personas' => $request->personas,
            'fecha' => $request->fecha_ini,
            'mesas' => $request->mesas,
            'color' => $request->color,
            'detalles' => $request->detalles,
        );

        Calendar::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', ' Bien Hecho']);
    }

    public function destroy($id) {
        $data = Calendar::findOrFail($id);
        $data->delete();
    }
}
