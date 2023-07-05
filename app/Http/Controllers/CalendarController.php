<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Calendar;
use App\Models\Mesa;

class CalendarController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->role == 'desarrollador'){
            $calendar = Calendar::all();
            $mesas = Mesa::select('titulo')
                ->where('titulo', 'NOT LIKE', '%Didi%')
                ->where('titulo', 'NOT LIKE', '%Para llevar%')
                ->where('titulo', 'NOT LIKE', '%Rappi%')
                ->where('titulo', 'NOT LIKE', '%Uber%')
                ->get();
             if(request()->ajax()){
                return datatables()->of(Calendar::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'"class="edit btn btn-primary btn-sm" >Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Calendar.index', compact('calendar','mesas'));
        }
        if (Auth::check() && Auth::user()->role == 'administrador')
        {
            $calendar = Calendar::all();
            $mesas = Mesa::select('titulo')
                ->where('titulo', 'NOT LIKE', '%Didi%')
                ->where('titulo', 'NOT LIKE', '%Para llevar%')
                ->where('titulo', 'NOT LIKE', '%Rappi%')
                ->where('titulo', 'NOT LIKE', '%Uber%')
                ->get();
             if(request()->ajax()){
                return datatables()->of(Calendar::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'"class="edit btn btn-primary btn-sm" >Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Calendar.index', compact('calendar', 'mesas'));
        }
        if(Auth::check() && Auth::user()->role == 'cajero'){
            $calendar = Calendar::all();
             $mesas = Mesa::select('titulo')
                ->where('titulo', 'NOT LIKE', '%Didi%')
                ->where('titulo', 'NOT LIKE', '%Para llevar%')
                ->where('titulo', 'NOT LIKE', '%Rappi%')
                ->where('titulo', 'NOT LIKE', '%Uber%')
                ->get();
             if(request()->ajax()){
                return datatables()->of(Calendar::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'"class="edit btn btn-primary btn-sm" >Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Calendar.index', compact('calendar','mesas'));
        }
        else{
            return view('error');
        }
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        $form_data = array(
            'titulo' => $request->titulo,
            'personas' => $request->personas,
            'fecha' => $request->fecha_ini,
            'mesas' => $request->mesas,
            'color' => $request->color,
            'detalles' => $request->detalles
        );

        Calendar::create($form_data);

        return response()->json(['success' => 'Exito' ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
         if(request()->ajax()){
            $data = Calendar::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $form_data = array(
            'titulo' => $request->titulo,
            'personas' => $request->personas,
            'fecha' => $request->fecha_ini,
            'mesas' => $request->mesas,
            'color' => $request->color,
            'detalles' => $request->detalles
        );

        Calendar::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', ' Bien Hecho']);
    }

    public function destroy($id)
    {
        $data = Calendar::findOrFail($id);
        $data->delete();
    }
}
