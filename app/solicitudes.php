<?php

namespace Gesol;

use Illuminate\Database\Eloquent\Model;

class solicitudes extends Model
{
	protected $table = 'solicitudes';
	protected $primaryKey = 'sol_id';
	public $timestamps = false;

	protected $fillable = ['sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_cedula'];
}
