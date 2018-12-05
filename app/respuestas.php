<?php

namespace Gesol;

use Illuminate\Database\Eloquent\Model;

class respuestas extends Model
{
   	protected $table = 'respuestas';
	protected $primaryKey = 'res_id';
	public $timestamps = false;

	protected $fillable = ['usu_cedula', 'res_formato', 'res_fechaRespuesta', 'sol_nombre'];
}
