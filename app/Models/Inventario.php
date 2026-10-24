<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\LogsActivityConChanges;


class Inventario extends Model
{
    use HasFactory, SoftDeletes, LogsActivityConChanges;
protected $fillable = [
        'nombre',
        'tipo',
        'estado',
        'marca',
        'modelo',
        'serial',
        'usuario_id'
    ];

public Function usuario(){

return $this->belongsTo(usuario_sistema::class, 'usuario_id');


}



    public function scopeSearch(Builder $query, ?string $term): void
    {
        $query->when($term, function (Builder $query, string $term) {
            $query->where(function (Builder $query) use ($term) {
               $query->where('nombre', 'like', "%{$term}%")
               ->orWhere('tipo', 'like', "%{$term}%")
                ->orWhere('marca', 'like', "%{$term}%")
                ->orWhere('modelo', 'like', "%{$term}%")
                ->orWhere('serial', 'like', "%{$term}%")
                ->orWhereHas('usuario', function (Builder $usuarioQuery) use ($term) {
                    $usuarioQuery->where('nombreUsuario', 'like', "%{$term}%");
                });
            });
        });
    }



}
