<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class imagenes extends Model
{
    use HasFactory;
    
protected $fillable = [
    'usuario_sistema_id',
    'category_id',
    'path'
]; 

public function usuario_sistema()
{
    return $this->belongsTo(usuario_sistema::class);
}

public function category()
{
    return $this->belongsTo(_c_b_i_t::class);  
}

}
