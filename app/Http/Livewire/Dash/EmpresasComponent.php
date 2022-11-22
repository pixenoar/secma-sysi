<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Empresa;

class EmpresasComponent extends Component{

    use WithFileUploads;

    public $moEmpresa;
    public $razon_social;
    public $cuit;
    public $direccion;
    public $telefono;
    public $cupo_user;
    public $costo_user;
    public $logo;

    //--------

    public function store(){

        $this->validate([
            'razon_social' => 'required|string|max:255',
            'cuit' => 'required|integer|digits_between:10,11',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'cupo_user' => 'required|integer',
            'costo_user' => 'required|integer',
            'logo' => 'required|image|mimes:png|max:1024',
        ]);

        $moEmpresa = new Empresa;
        $moEmpresa->razon_social = Str::title($this->razon_social);
        $moEmpresa->cuit = $this->cuit;
        $moEmpresa->direccion = $this->direccion;
        $moEmpresa->telefono = $this->telefono;
        $moEmpresa->cupo_user = $this->cupo_user;
        $moEmpresa->costo_user = $this->costo_user;

        // upload logo
        $path = $this->logo->store('public/empresas/logos');
        Image::make('../storage/app/'.$path)->widen(340)->save();
        $moEmpresa->logo = $path;

        $moEmpresa->save();

        $this->reset(['razon_social', 'cuit', 'direccion', 'telefono', 'cupo_user', 'costo_user', 'logo']);

        session()->flash('message', 'ok');

        
    }

    public function edit($id){

        $this->moEmpresa = Empresa::find($id);

        $this->razon_social = $this->moEmpresa->razon_social;
        $this->cuit = $this->moEmpresa->cuit;
        $this->direccion = $this->moEmpresa->direccion;
        $this->telefono = $this->moEmpresa->telefono;
        $this->cupo_user = $this->moEmpresa->cupo_user;
        $this->costo_user = number_format($this->moEmpresa->costo_user, 0, ',', '');
        
    }

    public function update(){

        $this->validate([
            'razon_social' => 'required|string|max:255',
            'cuit' => 'required|integer|digits_between:10,11',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'cupo_user' => 'required|integer',
            'costo_user' => 'required|integer',
            'logo' => 'nullable|image|mimes:png|max:1024',
        ]);


        $this->moEmpresa->razon_social = Str::title($this->razon_social);
        $this->moEmpresa->cuit = $this->cuit;
        $this->moEmpresa->direccion = $this->direccion;
        $this->moEmpresa->telefono = $this->telefono;
        $this->moEmpresa->cupo_user = $this->cupo_user;
        $this->moEmpresa->costo_user = $this->costo_user;

        // upload logo
        if($this->logo){
            $path = $this->logo->store('public/empresas/logos');
            Image::make('../storage/app/'.$path)->widen(340)->save();
            $this->moEmpresa->logo = $path;
        }

        $this->moEmpresa->save();

        session()->flash('message', 'ok');
        
    }

    public function show($id){
        $this->moEmpresa = Empresa::find($id);
    }

    public function estado($id){
        $moEmpresa = Empresa::find($id);

        if($moEmpresa->estado){
            $moEmpresa->estado = 0;
        }else{
            $moEmpresa->estado = 1;
        }

        $moEmpresa->save();
    }

    public function close(){
        $this->reset(['moEmpresa', 'razon_social', 'cuit', 'direccion', 'telefono', 'cupo_user', 'costo_user', 'logo']);
        $this->resetValidation();
    }

    public function render(){
        return view('livewire.dash.empresas-component',[
            'moEmpresas' => Empresa::orderBy('razon_social')->get()
        ])->layout('dash.main');
    }

}
