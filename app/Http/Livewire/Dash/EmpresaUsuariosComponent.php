<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;


use App\Models\Empresa;
use App\Models\User;
use App\Models\Rol;
use App\Models\Sector;
use App\Models\Puesto;
use App\Models\Evaluacion;


class EmpresaUsuariosComponent extends Component{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $moEmpresa;
    public $moUsuario;
    public $moRoles;
    public $moSector;
    public $moPuesto;
    public $moEvaluaciones = [];
    public $moEvaluacion;

    public $name;
    public $surname;
    public $dni;
    public $email;
    public $puesto;
    public $roles = [];

    public $busqueda;
    public $clon = false;

    // ----------------

    public function mount(Empresa $moEmpresa){
        $this->moEmpresa = $moEmpresa;
        
        if($this->moEmpresa->id == 1 && session('rol')->id == 1){
            $this->moRoles = Rol::all();
        }else{
            $this->moRoles = Rol::where('id', '>', 1)->get();
        }
    }

    public function updatedBusqueda(){
        $this->resetPage();
    }

    public function planes($user_id, $puesto_id){
        $this->moUsuario = User::find($user_id);
        $this->moPuesto = Puesto::find($puesto_id);
    }    

    public function evaluaciones($user_id){
        $this->moUsuario = User::find($user_id);
        $this->moEvaluaciones = $this->moUsuario->evaluaciones()->where('empresa_id', $this->moEmpresa->id)->orderBy('updated_at', 'desc')->get();
    }

    public function evaluacion($evaluacion_id){
        $this->moEvaluacion = Evaluacion::find($evaluacion_id);
    }

    public function updatedDni(){
        $this->usuario = User::where('dni', $this->dni)->first();
        if($this->usuario){
            $this->name = $this->usuario->name;
            $this->surname = $this->usuario->surname;
            $this->email = $this->usuario->email;
            $this->roles = $this->usuario->roles()->wherePivot('empresa_id', $this->moEmpresa->id)->pluck('id');
            $this->clon = true;
        }elseif($this->clon){
            $this->reset(['name', 'surname', 'email', 'roles', 'clon']);
        }
    }

    public function store(){

        $this->validate([
            'name' => 'exclude_if:clon,true|required|string|max:255',
            'surname' => 'exclude_if:clon,true|required|string|max:255',
            'dni' => 'required|integer|digits_between:7,8',
            'email' => 'exclude_if:clon,true|required|string|email|max:255|unique:users',
            'moSector' => 'required',
            'puesto' => 'required',
            'roles' => 'exclude_if:clon,true|required',
        ]);

        if($this->clon){
            $usuario = User::where('dni', $this->dni)->first();
        }else{
            $usuario = User::create([
                'name' => Str::title($this->name),
                'surname' => Str::title($this->surname),
                'dni' => $this->dni,
                'email' => Str::lower($this->email),
                'password' => Hash::make($this->dni),
            ]);

            event(new Registered($usuario));
        }

        foreach($this->roles as $rol) {
            $usuario->roles()->attach($rol, ['empresa_id' => $this->moEmpresa->id]);
        }

        $this->moEmpresa->usuarios()->attach($usuario->id, ['sector_id' => $this->moSector->id, 'puesto_id' => $this->puesto, 'clon' => $this->clon]);

        
        $this->reset(['name', 'surname', 'dni', 'email', 'moSector', 'puesto', 'roles', 'clon']);

        session()->flash('message', 'ok');
    
    }

    public function edit($user_id, $puesto_id, $clon){

        $this->moUsuario = User::find($user_id);
        $this->moPuesto = Puesto::find($puesto_id);
        $this->clon = $clon;

        $this->name = $this->moUsuario->name;
        $this->surname = $this->moUsuario->surname;
        $this->dni = $this->moUsuario->dni;
        $this->email = $this->moUsuario->email;
        $this->moSector = $this->moPuesto->sector;
        $this->puesto = $this->moPuesto->id;
        $this->roles = $this->moUsuario->roles()->wherePivot('empresa_id', $this->moEmpresa->id)->pluck('id');
        
    }

    public function update(){

        $this->validate([
            'name' => 'exclude_if:clon,true|required|string|max:255',
            'surname' => 'exclude_if:clon,true|required|string|max:255',
            'dni' => 'exclude_if:clon,true|required|integer|digits_between:7,8',
            'moSector' => 'required',
            'puesto' => 'required',
            'roles' => 'exclude_if:clon,true|required',
        ]);


        if(!$this->clon){
            $this->moUsuario->name = Str::title($this->name);
            $this->moUsuario->surname = Str::title($this->surname);
            $this->moUsuario->dni = $this->dni;
            $this->moUsuario->save();

            $this->moUsuario->roles()->wherePivot('empresa_id', $this->moEmpresa->id)->detach();
            
            foreach($this->roles as $rol) {
                $this->moUsuario->roles()->attach($rol, ['empresa_id' => $this->moEmpresa->id]);
            }
            //$this->moUsuario->roles()->attach($this->roles, ['empresa_id' => $this->moEmpresa->id]);            
        }


        $this->moEmpresa->usuarios()->updateExistingPivot($this->moUsuario->id, ['sector_id' => $this->moSector->id, 'puesto_id' => $this->puesto]);
    
        session()->flash('message', 'ok');

    }

    public function show($user_id, $puesto_id){
        $this->moUsuario = User::find($user_id);
        $this->moPuesto = Puesto::find($puesto_id);
    }

    public function estado($id){
        $moUsuario = User::find($id);

        if($moUsuario->estado){
            $moUsuario->estado = 0;
        }else{
            $moUsuario->estado = 1;
        }

        $moUsuario->save();
    }


    public function selSector($id){
        $this->moSector = Sector::find($id);
    }

    // ---

    public function close(){
        $this->reset(['name', 'surname', 'dni', 'email', 'moSector', 'puesto', 'roles', 'moUsuario', 'clon', 'moEvaluaciones']);
        $this->resetValidation();
    }

    public function closeEvaluacion(){
        $this->reset('moEvaluacion');
    }

    // ----------

    public function render(){
        return view('livewire.dash.empresa-usuarios-component',[
            'usuarios' => $this->moEmpresa->usuarios()->wherePivotIn('sector_id', $this->moEmpresa->getOrganigrama(session('rol')->id == 3 ? session('sector')->id : 0)->modelKeys())->where(function($query){ $query->Where('name', 'like', '%'.$this->busqueda.'%')->orWhere('surname', 'like', '%'.$this->busqueda.'%')->orWhere('dni', 'like', '%'.$this->busqueda.'%'); })->orderBy('surname')->orderBy('name')->paginate(2)
        ])->layout('dash.main');
    }

}