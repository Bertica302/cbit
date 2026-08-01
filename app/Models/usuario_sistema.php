<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class usuario_sistema extends Model
{

use HasFactory; 
    
protected $table = 'usuario_sistema';  
    protected $fillable=['nombreUsuario', 'clave', 'pregunta1', 'respuesta1', 'pegunta2', 'respuesta2', 'pregunta3', 'respuesta3', 'empleado_id'];   
  
    public function empleado(){
        return $this->belongsTo(empleado::class);   
        }

}
