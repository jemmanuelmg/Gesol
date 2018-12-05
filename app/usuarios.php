<?php

namespace Gesol;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class usuarios extends Authenticatable implements CanResetPasswordContract {

    use Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'usu_cedula';

    public $timestamps = false;

    //Campos que pueden ser llenados. El que no esté aquí quedará en blanco dentro de BD
    protected $fillable = [
        'usu_cedula', 
        'usu_nombres', 
        'usu_apellidos', 
        'usu_genero',
        'usu_fechaNac',
        'usu_telefono',
        'email',
        'rol_id',
        'password'
    ];

}
