<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ReporteIncidencia extends Model
{
    use SoftDeletes;
    use LogsActivity;

    /**
     * Categorías con las que se clasifica una incidencia.
     */
    public const CATEGORIAS = [
        'personal' => 'Personal',
        'infraestructura' => 'Infraestructura',
        'equipos' => 'Equipos',
        'otros' => 'Otros',
    ];

    protected $table = 'reportes_incidencias';

    protected $fillable = [
        'user_id',
        'asunto',
        'categoria',
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
            ->useLogName('reportes_incidencias');
    }

    public function usuario()
    {
        return $this->belongsTo(usuario_sistema::class, 'user_id');
    }

    public function estaResuelto(): bool
    {
        return $this->estado === 'resuelto';
    }

    public function categoriaEtiqueta(): string
    {
        return self::CATEGORIAS[$this->categoria] ?? ucfirst((string) $this->categoria);
    }
}
