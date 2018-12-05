<?php

namespace Gesol;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
   	protected $table = 'roles';
	protected $primaryKey = 'rol_id';
	protected $timestamps = false;
}
