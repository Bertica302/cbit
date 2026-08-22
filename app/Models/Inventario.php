<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
protected $fillable = [
        'nombre',
        'tipo',
        'estado',
        'marca',
        'modelo',
        'serial',
        'usuario',
        'created_at',
    ];

public Function usuario(){

return $this->belongsTo(usuario_sistema::class, 'usuario_id');


}

}
