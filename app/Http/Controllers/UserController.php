<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller{

    public function index(Empresa $empresa){
        $users = $empresa->users()->orderBy('name')->orderBy('surname')->get();
        return view('dash.users.index', compact('empresa', 'users'));
    }

    public function create(Empresa $empresa){
        $roles = Role::all();
        return view('dash.users.create', compact('empresa', 'roles'));
    }

    public function store(Request $request, Empresa $empresa){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'integer', 'digits_between:7,8', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'lwSector' => ['required'],
            'lwPuesto' => ['required'],
            'checks' => ['required'],
        ]);

        $user = User::create([
            'empresa_id' => $empresa->id,
            'sectore_id' => $request->lwSector,
            'puesto_id' => $request->lwPuesto,
            'name' => $request->name,
            'surname' => $request->surname,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => Hash::make('yoprogramo'),
        ]);

        event(new Registered($user));

        $user->roles()->attach($request->checks);

        return redirect()->route('empresas.users.index', $empresa);


    }

    public function show(Empresa $empresa, User $user){
        return view('dash.users.show', compact('empresa', 'user'));
    }

    public function edit(Empresa $empresa, User $user){
        $roles = Role::all();
        return view('dash.users.edit', compact('empresa', 'user', 'roles'));
    }

    public function update(Request $request, Empresa $empresa, User $user){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->save();
        
        $user->roles()->detach($user->roles);
        $user->roles()->attach($request->checks);

        return redirect()->route('empresas.users.index', $empresa);

    }

    public function destroy(User $user){
        //
    }

}
