<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index() {

        if (Auth::check() && Auth::user()->role == 'administrador') {
            $horario = Horario::all();

            $user = User::where('role', '=', 'cajero')
                ->orwhere('role', '=', 'administrador')
                ->get();
            return view('usuarios.index', compact('user', 'horario'));
        }
        else {
            return view('error');
        }

        $user = User::all();

        return view('usuarios.index', compact('user'));
    }

    public function create() {
        return view('usuarios.create', compact('horario'));
    }

    public function store(Request $request) {

        $user = new User;
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->turno = $request->turno;
        $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario agregado exitosamente.');

    }

    public function show($id) {
        $user = User::find($id);
        return view('usuarios.show', ['user' => $user]);
    }

    public function edit($id) {
        $horario = Horario::all();
        $user = User::where('id', $id)->get();
        return view('usuarios.edit', compact('user', 'horario'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->turno = $request->turno;
        $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }


    public function destroy($id) {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function updateFecha(Request $request) {

        $administrador = $request->administrador;
        $cajero = $request->cajero;

        User::where('role', 'administrador')->update(['expiracion' => $administrador]);
        User::where('role', 'cajero')->update(['expiracion' => $cajero]);

        return response()->json(['success', ' Bien Hecho']);
    }

    public function editFecha() {
        if (request()->ajax()) {
            $exp2 = DB::table('users')
                ->select('id', 'role', 'expiracion')
                ->where('role', 'administrador')
                ->first();
            $exp3 = DB::table('users')
                ->select('id', 'role', 'expiracion')
                ->where('role', 'cajero')
                ->first();
            return response()->json(['exp2' => $exp2, 'exp3' => $exp3]);
        }
    }
}
