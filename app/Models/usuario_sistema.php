<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;   
use Spatie\Permission\Traits\HasRoles;

class usuario_sistema extends Model    
{

use hasRoles;

use HasFactory; 
    
protected $table = 'usuario_sistema';  
    protected $fillable=['nombreUsuario', 'clave', 'pregunta1', 'respuesta1', 'pregunta3', 'respuesta3', 'empleado_id'];   
  
    public function empleado(){
        return $this->belongsTo(empleado::class, 'empleado_id', 'id');    
        }

}
