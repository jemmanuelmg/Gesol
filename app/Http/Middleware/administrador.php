<?php

namespace Gesol\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Closure;

    /**
     *Para que funcione tiene que crearse con cmd 
     *php artisan make:middleware nombre_mid
     *y luego registrarse en Http/kernel
     */

class administrador
{

    protected $auth;

    public function __construct(Guard $auth){

        $this->auth = $auth;

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /**
         * Aquí se escribe lo que se va a validar
         * en este caso, se accesa a el atributo rol_id del usuario
         * si no es 3, no es administrador.
         */  

        if ($this->auth->user()->rol_id != 3) {
            
            Session::flash('mensaje-error', 'Sin privilegios de coordinador para entrar a ese apartado');
            return Redirect::to('/');
        }

        return $next($request);
    }
}
