<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Relations\HasMany;

class rol extends Model
{
    use HasFactory;     
     
    protected $table = 'rol'; 
    protected $fillable=['nombre', 'descripcion'];    

    public function empleado(): HasMany 
    {
        return $this->hasMany(empleado::class);   
}
}