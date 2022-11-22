<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Illuminate\Support\Str;

// Modelos
use App\Models\Empresa;
use App\Models\Sector;
use App\Models\Puesto;

class EmpresaOrganigramaComponent extends Component{

    public $moEmpresa;
    public $moSector;
    public $moPuesto;

    public $seNombre;
    public $puNombre;

    // ----------------


    public function mount(Empresa $moEmpresa){
        $this->moEmpresa = $moEmpresa;
    }

    // Sectores

    public function storeSector(){

        $this->validate([
            'seNombre' => 'required|string|max:255',
        ]);

        if($this->moSector){
            $padre_id = $this->moSector->id;
        }else{
            $padre_id = 0;
        }

        $sector = new Sector;
        $sector->empresa_id = $this->moEmpresa->id;
        $sector->padre_id = $padre_id;
        $sector->nombre = Str::title($this->seNombre);
        $sector->save();

        $this->reset(['moSector', 'seNombre']);

        session()->flash('message', 'ok');

        $this->moEmpresa->refresh();

    }

    public function editSector($id){

        $this->moSector = Sector::find($id);
        $this->seNombre = $this->moSector->nombre;
        
    }

    public function updateSector(){

        $this->validate([
            'seNombre' => 'required|string|max:255',
        ]);

        $this->moSector->nombre = Str::title($this->seNombre); 
        $this->moSector->save();

        session()->flash('message', 'ok');

        $this->moEmpresa->refresh();
        
    }

    // Puestos

    public function puestos($id){
        $this->moSector = Sector::find($id);
    }

    public function storePuesto(){

        $this->validate([
            'puNombre' => 'required|string|max:255',
        ]);

        $puesto = new Puesto;
        $puesto->sector_id = $this->moSector->id;
        $puesto->nombre = Str::title($this->puNombre);
        $puesto->save();

        $this->reset(['puNombre']);

        $this->moSector->refresh();

        session()->flash('message', 'ok');

    }

    public function editPuesto($id){

        $this->moPuesto = Puesto::find($id);
        $this->puNombre = $this->moPuesto->nombre;
        
    }

    public function updatePuesto(){

        $this->validate([
            'puNombre' => 'required|string|max:255',
        ]);

        $this->moPuesto->nombre = Str::title($this->puNombre);
        $this->moPuesto->save();

        $this->moSector->refresh();

        session()->flash('message', 'ok');
        
    }

    // Organigrama

    public function selSector($id){
        $this->moSector = Sector::find($id);
    }

    public function volver(){
        $this->reset(['moPuesto', 'puNombre']);
        $this->resetValidation();
    }

    public function close(){
        $this->reset(['moSector', 'seNombre', 'puNombre']);
        $this->resetValidation();
    }

    // ----------

    public function render(){
        return view('livewire.dash.empresa-organigrama-component',[
            'sectores' => Sector::where('empresa_id', $this->moEmpresa->id)->where('padre_id', 0)->orderBy('nombre')->get()
        ])->layout('dash.main');
    }

}