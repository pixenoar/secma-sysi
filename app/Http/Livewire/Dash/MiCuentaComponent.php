<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class MiCuentaComponent extends Component{

    public $password_current;
    public $password;
    public $password_confirmation;

    public function update(){

        $this->validate([
            'password_current' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if(Hash::check($this->password_current, Auth::user()->password)){

            Auth::user()->password = Hash::make($this->password);
            Auth::user()->save();
    
            event(new PasswordReset(Auth::user()));
            
            session()->flash('ok', 'La contraseña fue modificada con éxito');
            
        }else{
            session()->flash('error', 'La contraseña ingresada no coincide con la actual');
        }

        $this->reset(['password_current', 'password', 'password_confirmation']);


    }
    
    public function render(){
        return view('livewire.dash.mi-cuenta-component')->layout('dash.main');
    }

}
