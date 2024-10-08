<?php

namespace App\Http\Controllers;

use App\Models\PayMethod;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayMethodController extends Controller
{
    public function index() {

        if (Auth::check() && Auth::user()->role == 'administrador') {

            $payco = PayMethod::all()->count();
            $paymethod = PayMethod::all();

            if (request()->ajax()) {
                return datatables()->of(PayMethod::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('paymethod.index', compact('paymethod', 'payco'));
        }

        if (Auth::check() && Auth::user()->role == 'gerente') {

            $payco = PayMethod::all()->count();
            $paymethod = PayMethod::all();

            if (request()->ajax()) {
                return datatables()->of(PayMethod::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('paymethod.index', compact('paymethod', 'payco'));
        }

        if (Auth::check() && Auth::user()->role == 'recepcionista') {

            $payco = PayMethod::all()->count();
            $paymethod = PayMethod::all();

            if (request()->ajax()) {
                return datatables()->of(PayMethod::latest()->get())
                    ->addColumn('action', function ($data) {
                        $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-ms">Editar</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('paymethod.index', compact('paymethod', 'payco'));
        } else {
            return view('error');
        }
    }

    public function store(Request $request) {
        $form_data = array(
            'titulo' => $request->titulo,
        );
        PayMethod::Create($form_data);
        return response()->json(['success' => 'Registado con exito']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $data = PayMethod::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request) {
        $form_data = array(
            'titulo' => $request->titulo,
        );
        PayMethod::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success', ' Bien Hecho']);
    }

    public function destroy($id) {
        $data = PayMethod::findOrFail($id);
        $data->delete();
    }
}
