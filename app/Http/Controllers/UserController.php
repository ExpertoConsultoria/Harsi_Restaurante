<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Horario;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::check() && Auth::user()->role == 'desarrollador') {
            $user = User::all()->except(Auth::id());
            return view('usuarios.index', compact('user'));
        }
        if (Auth::check() && Auth::user()->role == 'administrador') {
            $horario = Horario::all();
            //dd($horario);
            $user = User::where('role','=','cajero' )
                ->orwhere('role','=','administrador')
                ->get();
            return view('usuarios.index', compact('user','horario'));
        }
//        if (Auth::check() && Auth::user()->role == 'cajero') {
//            $user = User::where('role','=','recepcionista' )
//                ->orwhere('role','=','gerente')->get();
//            return view('usuarios.index', compact('user'));
//        }
        else{
            return view ('error');
        }

         $user = User::all();


        return view('usuarios.index', compact('user'));

    }

    // public function search(Request $request){
    //      $user = User::orderBy('id', 'desc');
    //     return view('usuarios.index', compact('user'));

    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('usuarios.create', compact('horario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user= new User;
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->turno = $request->turno;
        $user->save();

        return redirect()->route('usuarios.index')->with('success','Usuario agregado exitosamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::all();
        $user = User::where('id', $id)->get();
        return view('usuarios.edit' , compact('user','horario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->turno = $request->turno;
        $user->save();

        return redirect()->route('usuarios.index')->with('success','Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id' , $id)->first();
        $user->delete();
        return redirect()->route('usuarios.index')->with('success','Usuario eliminado exitosamente.');
    }

      public function updateFecha(Request $request)
    {

       $desarrollador= $request->desarrollador;
       $administrador= $request->administrador;
       $cajero= $request->cajero;

       User::where('role','desarrollador')->update(['expiracion'=>$desarrollador]);
       User::where('role','administrador')->update(['expiracion'=>$administrador]);
       User::where('role','cajero')->update(['expiracion'=>$cajero]);

       //return response()->json($cajero);
       return response()->json(['success', ' Bien Hecho']);
    }

      public function editFecha()
    {
        if(request()->ajax()){
            $exp1 = \DB::table('users')
                    ->select('id','role', 'expiracion')
                    ->where('role','desarrollador')
                    ->first();
            $exp2 = \DB::table('users')
                    ->select('id','role', 'expiracion')
                    ->where('role','administrador')
                    ->first();
            $exp3 = \DB::table('users')
                    ->select('id','role', 'expiracion')
                    ->where('role','cajero')
                    ->first();
            return response()->json(['exp1' => $exp1,'exp2' => $exp2,'exp3' => $exp3]);
        }
    }
}
