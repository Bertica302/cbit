<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;



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
        'usuario_id',
        'created_at',
    ];

public Function usuario(){

return $this->belongsTo(usuario_sistema::class, 'usuario_id');


}

	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->useLogName('Inventario');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $usuarioId = session('id');
        if ($usuarioId) {
            $activity->causer_id = $usuarioId;
            $activity->causer_type = \App\Models\usuario_sistema::class;
        }
    }



}
