<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Empresa;
use App\Models\Profesor;


class EmpresaProfesoresComponent extends Component{

    use WithFileUploads;

    public $moEmpresa;
    public $moProfesor;
    public $nombre;
    public $apellido;
    public $dni;
    public $telefono;
    public $email;
    public $titulo;
    public $matricula;
    public $firma;

    // ----------------

    public function mount(Empresa $moEmpresa){
        $this->moEmpresa = $moEmpresa;
    }

    public function store(){

        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|integer|digits_between:7,8',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'titulo' => 'required|string|max:255',
            'matricula' => 'required|string|max:255',
            'firma' => 'required|image|mimes:png|max:1024',
        ]);

        $profesor = new Profesor;
        $profesor->empresa_id = $this->moEmpresa->id;
        $profesor->nombre = Str::title($this->nombre);
        $profesor->apellido = Str::title($this->apellido);
        $profesor->dni = $this->dni;
        $profesor->telefono = $this->telefono;
        $profesor->email = Str::lower($this->email);
        $profesor->titulo = Str::title($this->titulo);
        $profesor->matricula = $this->matricula;

        // Upload archivo
        if($this->firma){
            $path = $this->firma->store('public/profesores/firmas');
            Image::make('../storage/app/'.$path)->widen(340)->save();
            $profesor->firma = $path;            
        }

        $profesor->save();

        $this->reset(['nombre', 'apellido', 'dni', 'telefono', 'email', 'titulo', 'matricula', 'firma']);

        $this->moEmpresa->refresh();

        session()->flash('message', 'ok');
        
    }

    public function edit($id){

        $this->moProfesor = Profesor::find($id);

        $this->nombre = $this->moProfesor->nombre;
        $this->apellido = $this->moProfesor->apellido;
        $this->dni = $this->moProfesor->dni;
        $this->telefono = $this->moProfesor->telefono;
        $this->email = $this->moProfesor->email;
        $this->titulo = $this->moProfesor->titulo;
        $this->matricula = $this->moProfesor->matricula;
        
    }

    public function update(){

        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|integer|digits_between:7,8',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'titulo' => 'required|string|max:255',
            'matricula' => 'required|string|max:255',
            'firma' => 'nullable|image|mimes:png|max:1024',
        ]);

        $this->moProfesor->nombre = Str::title($this->nombre);
        $this->moProfesor->apellido = Str::title($this->apellido);
        $this->moProfesor->dni = $this->dni;
        $this->moProfesor->telefono = $this->telefono;
        $this->moProfesor->email = Str::lower($this->email);
        $this->moProfesor->titulo = Str::title($this->titulo);
        $this->moProfesor->matricula = $this->matricula;

        
        if($this->firma){
            // Borro archivo anterior
            Storage::delete($this->moProfesor->firma);
            // Upload archivo
            $path = $this->firma->store('public/profesores/firmas');
            Image::make('../storage/app/'.$path)->widen(340)->save();
            $this->moProfesor->firma = $path;            
        }

        $this->moProfesor->save();

        $this->reset('firma');

        $this->moEmpresa->refresh();

        session()->flash('message', 'ok');
        
    }

    public function show($id){
        $this->moProfesor = Profesor::find($id);
    }

    public function estado($id){
        $moProfesor = Profesor::find($id);

        if($moProfesor->estado){
            $moProfesor->estado = 0;
        }else{
            $moProfesor->estado = 1;
        }

        $moProfesor->save();
    }

    public function close(){
        $this->reset(['moProfesor', 'nombre', 'apellido', 'dni', 'telefono', 'email', 'titulo', 'matricula', 'firma']);
        $this->resetValidation();
    }

    public function render(){
        return view('livewire.dash.empresa-profesores-component',[
            'profesores' => $this->moEmpresa->profesores()->orderBy('apellido')->orderBy('nombre')->get()
        ])->layout('dash.main');
    }

}