<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Relations\HasMany;

class _c_b_i_t extends Model
{
   use HasFactory;
protected $table = '_c_b_i_t';
    protected $fillable=['nombre', 'parroquia_id', 'direccion'];   

    public function empleado(): HasMany
    {
           return $this->hasMany(empleado::class);    
    }

    public function parroquia(){ 
        return $this->belongsTo(parroquia::class);     
        }
}
