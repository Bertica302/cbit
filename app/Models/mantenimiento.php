<?php

namespace App\Models;

use App\Models\Scopes\PermisoCbit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\LogsActivityConChanges;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;

class mantenimiento extends Model
{

use SoftDeletes, LogsActivityConChanges;

     Protected $table = 'mantenimiento';

    protected $fillable = [
        'usuario_id',
        'inventario_id',
        'tipo',
        'descripcion',
        'tecnico',
        'estado',
        'fecha_retorno'
    ];



    public function usuario()
    {
        return $this->belongsTo(usuario_sistema::class, 'usuario_id');
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'inventario_id');
    }

}
