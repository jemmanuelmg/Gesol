<?php

namespace Gesol\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Closure;

class autenticado
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
        
        if(Session('sesionIniciada') != true){
            Session::flash('mensaje-error', 'Porfavor, inicie sesion antes de continuar.');
            
            return redirect('/');
        }

        return $next($request);
    }
}

