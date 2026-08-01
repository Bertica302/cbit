<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  


class rol extends Model
{
    use HasFactory;     
     
    protected $table = 'rol'; 
    protected $fillable=['nombre', 'A_contratacion', 'serial'];    

    public function empleado(): HasMany 
    {
        return $this->hasMany(empleado::class);   
}
}