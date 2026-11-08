<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\_c_b_i_t; 

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'cbit_id',
        'user_id',
    ];

   
    public function cbit()
    {
        return $this->belongsTo(_c_b_i_t::class, 'cbit_id');
    }

    public function user()
{
    return $this->belongsTo(usuario_sistema::class, 'user_id', 'id');
}
}
