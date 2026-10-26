<?php

namespace App\Models;

use App\Models\Scopes\PermisoCbit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\LogsActivityConChanges;
use Illuminate\Support\facades\Auth;

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


 protected static function booted(): void {

    //aplicando filtro automatico para todas las consultas, de forma que se limite que el usuario solo pueda ver los registros de su centro.

    static::addGlobalScope((new PermisoCbit));

    static::creating(function ($model){

    if(Auth::check()){

    if (empty($model->_c_b_i_t_id)){
    $model->_c_b_i_t_id = Auth::user()->empleado?->_c_b_i_t_id;}

    if (empty($model->user_id))
        $model->usuario_id = Auth::id();



    }

 });


 }



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
