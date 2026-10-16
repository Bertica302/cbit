<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    // Campos permitidos para la asignación masiva (Mass Assignment)
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'cbit_id',
        'user_id',
    ];

    /**
     * Relación: Un curso pertenece a un CBIT.
     */
    public function cbit()
    {
        return $this->belongsTo(Cbit::class);
    }

    /**
     * Relación: Un curso fue registrado por un usuario (trabajador).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
