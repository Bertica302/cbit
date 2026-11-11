<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ReporteFalla extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'reportes_fallas';

    protected $fillable = [
        'user_id',
        'asunto',
        'descripcion',
        'prioridad',
        'estado',
    ];

    // Registra automáticamente create / update / delete / restore
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('reportes_fallas');
    }

    public function usuario()
    {
        return $this->belongsTo(usuario_sistema::class, 'user_id');
    }
}