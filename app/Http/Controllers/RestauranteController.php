<?php

namespace App\Http\Controllers;

use App\Models\DescuentoUsuario;
use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestauranteController extends Controller
{

    public function index()
    {
        if (Auth::user()->role !== 'administrador') {
            return view('error');
        }


        if (request()->ajax()) {
            return datatables()->of(Restaurante::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '"class="edit btn btn-primary btn-sm" >Editar</button>';

                    if ($data->id != 1) {
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        $contador = Restaurante::exists() ? Restaurante::count() : '';

        $user = User::where('role', 'administrador')
                    ->select('id', 'name', 'role', 'expiracion')
                    ->first();

        $userData = $user
            ? [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'expiracion' => $user->expiracion ?? '',
                ]
            : [
                'id' => 0,
                'name' => '',
                'role' => '',
                'expiracion' => '',
                ];

        return view('restaurante.index', compact('userData', 'contador'));

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
            $administrador = DescuentoUsuario::select('descuento')
                                ->where('role', 'Administrador')
                                ->first();
            $cajero = DescuentoUsuario::select('descuento')
                                ->where('role', 'Cajero')
                                ->first();
            $jefe_meseros = DescuentoUsuario::select('descuento')
                                ->where('role', 'Jefe de Meseros')
                                ->first();
            $jefe_cocina = DescuentoUsuario::select('descuento')
                                ->where('role', 'Jefe de Cocina')
                                ->first();

            return response()->json(['administrador' => $administrador?->descuento, 'cajero' => $cajero?->descuento, 'jefe_meseros' => $jefe_meseros?->descuento, 'jefe_cocina' => $jefe_cocina?->descuento]);
        }
    }

    public function updateDescuento(Request $request)
    {
        $roles = [
            'Administrador' => $request->administrador,
            'Cajero' => $request->cajero,
            'Jefe de Meseros' => $request->jefe_meseros,
            'Jefe de Cocina' => $request->jefe_cocina
        ];

        // Realiza las actualizaciones en un solo ciclo
        foreach ($roles as $role => $descuento) {
            DescuentoUsuario::where('role', $role)->update(['descuento' => $descuento]);
        }

        return response()->json(['success' => '¡Bien hecho!']);
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
