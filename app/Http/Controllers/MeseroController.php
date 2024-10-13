<?php

namespace App\Http\Controllers;

use App\Models\Mesero;
use App\Models\Restaurante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeseroController extends Controller
{

    public function index() {

        $restaurante = Restaurante::first();

        if (request()->ajax()) {
            return datatables()->of(Mesero::latest()->get())
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

        return view('Meseros.index', compact('restaurante'));
    }

    public function store(Request $request) {
        $form_data = array(
            'full_name' => $request->full_name,
        );

        Mesero::create($form_data);

        return response()->json(['success' => 'Exito']);
    }

    public function edit($id) {
        $data = Mesero::findOrFail($id);
        return response()->json(['data' => $data]);
    }


    public function update(Request $request) {
        $form_data = array(
            'full_name' => $request->full_name,
        );

        Mesero::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success', 'Bien Hecho']);
    }


    public function destroy($id) {
        $data = Mesero::findOrFail($id);
        $data->delete();
    }
}
