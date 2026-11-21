<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class actividad extends Model
{
    
use HasFactory 
protected $table = '_c_b_i_t'; 
    protected $fillable=['nombre', 'parroquia_id', 'direccion'];   
  
}
