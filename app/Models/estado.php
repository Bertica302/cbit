<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Relations\HasMany;
class estado extends Model
{
    use HasFactory;     
     
    protected $table = 'estado'; 
    protected $fillable=['nombre'];  
    
    public function Municipios(): HasMany
    {
        return $this->hasMany(municipio::class);
}

}
