<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class municipio extends Model
{
    use HasFactory;     
     
    protected $table = 'municipio';   
    protected $fillable=['nombre', 'estado_id'];    
    
    public function parroquia(): HasMany 
    {
        return $this->hasMany(parroquia::class);  
}

    public function estado(){
        return $this->belongsTo(estado::class, 'estado_id');   
}
}
