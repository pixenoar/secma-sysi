<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectUserEmpresaRol{

    public function handle(Request $request, Closure $next){

        if(session('empresa')->id <> 1) {
            return redirect()->route('change.rol', session('rol')->id);
        }elseif(session('rol')->id <> 1){
            return redirect()->route('change.rol', session('rol')->id);
        }

        return $next($request);

    }

}
