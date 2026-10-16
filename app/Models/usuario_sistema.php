<?php

namespace App\Models;
// use Illuminate\Database\Eloquent\Model; cambiado por Authenticatable para poder usar el login.
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;   
use Spatie\Permission\Traits\HasRoles;



class usuario_sistema extends Authenticatable    
{

use hasRoles;   
use HasFactory; 
    
protected $table = 'usuario_sistema';  
    protected $fillable=['nombreUsuario', 'clave', 'pregunta1', 'respuesta1', 'pregunta3', 'respuesta3', 'empleado_id'];   
  
    public function empleado(){
        return $this->belongsTo(empleado::class, 'empleado_id', 'id');    
        }

         public function getAuthPasswordName(): string
    {
        return 'clave';
    }

}
