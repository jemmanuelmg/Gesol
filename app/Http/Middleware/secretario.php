<?php

namespace Gesol\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Closure;

class secretario
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
        if ($this->auth->user()->rol_id != 2 && $this->auth->user()->rol_id != 3  && $this->auth->user()->rol_id != 4 && $this->auth->user()->rol_id != 5) {
            
            Session::flash('mensaje-error', 'Sin privilegios para responder solicitudes.');
            return Redirect::to('/');
        }

        return $next($request);
    }
}
