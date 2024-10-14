<?php

namespace App\Http\Controllers;

use App\Models\Guia;
use App\Models\Restaurante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GuiaController extends Controller
{

    public function index() {

        if (Auth::user()->role !== 'administrador') {
            return view('error');
        }

        $restaurante = Restaurante::first();

        if (request()->ajax()) {
            return datatables()->of(Guia::latest()->get())
                ->addColumn('action', function ($data) {
                    if ($data->id != 1) {
                        $button = '<button
                                    type="button"
                                    name="edit"
                                    id="' . $data->id . '"
                                    class="edit btn btn-warning btn-sm"
                                >
                                    <i class="fas fa-pen"></i>
                                </button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button
                                        type="button"
                                        name="delete"
                                        id="' . $data->id . '"
                                        class="delete btn btn-danger btn-sm"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Guias.index', compact('restaurante'));
    }

    public function store(Request $request) {
        $form_data = array(
            'full_name' => $request->full_name,
        );

        Guia::create($form_data);

        return response()->json(['success' => 'Exito']);
    }

    public function edit($id) {
        $data = Guia::findOrFail($id);
        return response()->json(['data' => $data]);
    }


    public function update(Request $request) {
        $form_data = array(
            'full_name' => $request->full_name,
        );

        Guia::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success', 'Bien Hecho']);
    }


    public function destroy($id) {
        $data = Guia::findOrFail($id);
        $data->delete();
    }
}
