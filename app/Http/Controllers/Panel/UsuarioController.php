<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('panel.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = NULL;
        $roles = Role::all();
        return view('panel.usuarios.form', compact('usuario', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required',
            'last_name' => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|min:5',
            'role'      => 'required',
            'phone'     => 'nullable',
            'uuid'      => 'nullable',
        ]);

        $user = new User;
        $user->name       = $data['name'];
        $user->last_name  = $data['last_name'];
        $user->email      = $data['email'];
        $user->phone      = $data['phone'];
        $user->uuid       = $data['uuid'];
        $user->password   = Hash::make($data['password']);
        $user->save();

        $user->assignRole($request->role);

        return redirect()->route('panel.usuarios.index')->with('message', 'Usuario creado correctamente!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view_mode = 'readonly';
        $usuario = config('demo.usuarios')[$id];

        return view('panel.usuarios.form', compact('usuario', 'view_mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('panel.usuarios.form', compact('usuario', 'roles'));
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
        $user = User::with('roles')->whereId($id)->first();

        $data = $request->validate([
            'name'      => 'required',
            'last_name' => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'password'  => 'required|confirmed|min:5',
            'role'      => 'required',
            'phone'     => 'nullable',
            'uuid'      => 'nullable',
        ]);


        if($user->password != $request->password){
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);
        $user->save();

        if($user->roles->first()->id != $data['role']) {
            $user->roles()->detach();
            $role = Role::find($data['role']);
            $user->roles()->attach($role);
        }

        return redirect()->route('panel.usuarios.index')->with('message', 'Usuario modificado correctamente!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('OK');

    }

    /**
     * Update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $user = User::find($id);
        $user->status = $user->status === 'ACTIVO' ? 0 : 1;
        $user->save();
        return response()->json($user->status);
    }

    public function historial()
    {
    }
}
