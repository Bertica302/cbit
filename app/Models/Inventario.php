<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Override;
use Spatie\Activitylog\Traits\LogsActivity;

class Inventario extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
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

#[Override]
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }




}
