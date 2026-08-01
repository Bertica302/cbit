<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class parroquia extends Model
{
    use HasFactory;     
     
    protected $table = 'parroquia'; 
    protected $fillable=['nombre_parroquia', 'municipio_id'];       


    public function empleado()   
{
        return $this->hasOne(empleado::class);    
} 
  public function municipio(){
        return $this->belongsTo(municipio::class);   
}
public function _c_b_i_t(): HasMany
{
        return $this->hasMany(_c_b_i_t::class);      
}

}