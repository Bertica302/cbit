<?php

namespace App\Models;
<<<<<<< HEAD
// use Illuminate\Database\Eloquent\Model; cambiado por Authenticatable para poder usar el login.
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;   
use Spatie\Permission\Traits\HasRoles;



class usuario_sistema extends Authenticatable    
{

use hasRoles;   
=======

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class usuario_sistema extends Model
{

>>>>>>> rama_de_Talleres
use HasFactory; 
    
protected $table = 'usuario_sistema';  
    protected $fillable=['nombreUsuario', 'clave', 'pregunta1', 'respuesta1', 'pregunta3', 'respuesta3', 'empleado_id'];   
  
    public function empleado(){
<<<<<<< HEAD
        return $this->belongsTo(empleado::class, 'empleado_id', 'id');    
        }

         public function getAuthPasswordName(): string
    {
        return 'clave';
    }

=======
        return $this->belongsTo(empleado::class);   
        }

>>>>>>> rama_de_Talleres
}
