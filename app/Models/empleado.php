<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class empleado extends Model
{
   use HasFactory;     
     
    protected $table = 'empleado'; 
    protected $fillable=['nombres', 'apellidos', 'cedula', 'sexo', 'fec_nac', 'correo_electronico', 'rol_id', '_c_b_i_t_id', 'parroquia_id', 'direccion'];  
    
    public function rol(){
        return $this->belongsTo(rol::class);  
        }

     public function _c_b_i_t(){ 
        return $this->belongsTo(_c_b_i_t::class);   
        }  
        
        
    public function parroquia(){ 
        return $this->belongsTo(parroquia::class);   
        }     
        
} 

