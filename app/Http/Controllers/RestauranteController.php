<?php

namespace App\Http\Controllers;

use App\Models\DescuentoUsuario;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{

    public function index()
    {
        $restaurante = Restaurante::all();

        if (request()->ajax()) {
            return datatables()->of(Restaurante::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '"class="edit btn btn-primary btn-sm" >Editar</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $dato = Restaurante::min('id');

        if ($dato != null) {
            $contador = Restaurante::select('id')->count();
        } else {
            $contador = '';
        }

        $dato = User::min('id');

        if ($dato != null) {
            $user = User::select('id', 'name', 'role', 'expiracion')
                ->where('role', 'administrador')
                ->first();

            if ($user->expiracion != null) {
                $user = array(
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' => $user->role,
                    'expiracion' => $user->expiracion,
                );

            } else {
                $user = array(
                    'id' => 0,
                    'name' => '',
                    'role' => '',
                    'expiracion' => '',
                );
            }

        }

        return view('restaurante.index', compact('user', 'restaurante', 'contador'));
    }

    public function store(Request $request) {

        $form_data = array(
            'nombre' => $request->nombre,
            'rfc' => $request->rfc,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->correo,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'youTube' => $request->youTube,
            'linkedIn' => $request->linkedIn,
        );

        Restaurante::create($form_data);

        return response()->json(['success' => 'Exito']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $data = Restaurante::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function editDescuento() {
        if (request()->ajax()) {
            $data1 = DescuentoUsuario::select('id', 'role', 'descuento')
                ->where('role', 'Administrador')
                ->first();
            $data2 = DescuentoUsuario::select('id', 'role', 'descuento')
                ->where('role', 'Cajero')
                ->first();
            return response()->json(['data1' => $data1, 'data2' => $data2]);
        }
    }

    public function updateDescuento(Request $request) {

        $administrador = $request->administrador;
        $cajero = $request->cajero;

        DescuentoUsuario::where('role', 'Administrador')->update(['descuento' => $administrador]);
        DescuentoUsuario::where('role', 'Cajero')->update(['descuento' => $cajero]);

        return response()->json(['success', ' Bien Hecho']);
    }

    public function editSubcategoria() {

        if (request()->ajax()) {

            $dato = Restaurante::min('id');

            if ($dato != null) {
                $data = Restaurante::select('id', 'subcategoria')->first();
                if ($data->subcategoria != null) {
                    $data = array(
                        'id' => $data->id,
                        'subcategoria' => $data->subcategoria,
                    );
                }
            } else {
                $data = array(
                    'id' => 0,
                    'subcategoria' => 'No',
                );
            }

            return response()->json(['data' => $data]);
        }
    }

    public function updateSubcategoria(Request $request) {

        $dato = Restaurante::min('id');

        if ($dato != null) {
            Restaurante::whereId($request->hidden_id3)->update(['subcategoria' => $request->subcategoria3]);
            return response()->json(['success', ' Bien Hecho']);
        } else {
            return response()->json(['error', 'No hay datos del restaurante, agregue
            información del restaurante.', ]);
        }

    }

    public function editReducir() {
        if (request()->ajax()) {

            $dato = Restaurante::min('id');

            if ($dato != null) {
                $data = Restaurante::select('id', 'reducir')->first();
                if ($data->reducir != null) {
                    $data = array(
                        'id' => $data->id,
                        'reducir' => $data->reducir,
                    );
                }
            } else {
                $data = array(
                    'id' => 0,
                    'reducir' => 'No',
                );
            }
            return response()->json(['data' => $data]);
        }
    }

    public function updateReducir(Request $request) {

        $dato = Restaurante::min('id');

        if ($dato != null) {
            Restaurante::whereId($request->hidden_id4)->update(['reducir' => $request->reducir]);
            return response()->json(['success', ' Bien Hecho']);
        } else {
            return response()->json(['error', 'No hay datos del restaurante, agregue
            información del restaurante.', ]);
        }
    }

    public function update(Request $request) {

        $form_data = array(
            'nombre' => $request->nombre,
            'rfc' => $request->rfc,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'youTube' => $request->youTube,
            'linkedIn' => $request->linkedIn,
        );

        Restaurante::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success', ' Bien Hecho']);
    }

    public function destroy($id) {
        $data = Restaurante::findOrFail($id);
        $data->delete();
    }
}
