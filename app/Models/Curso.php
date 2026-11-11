<?php

namespace App\Models;

use App\Models\Scopes\PermisoCbit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\LogsActivityConChanges;
use Illuminate\Support\Facades\Auth;

class Curso extends Model
{
    use HasFactory, SoftDeletes, LogsActivityConChanges;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'tipo',
        'descripcion',
        'cbit_id',
        'user_id',
        'fecha_fin',
        'activo',
    ];

    protected static function booted(): void 
    {
        // Aplicando filtro automático para que el usuario solo vea los registros de su centro
        static::addGlobalScope((new PermisoCbit));

        static::creating(function ($model) {
            if (Auth::check()) {
                // Asignar CBIT automáticamente si está vacío
                if (empty($model->cbit_id)) {
                    $model->cbit_id = Auth::user()->empleado?->_c_b_i_t_id;
                }

                // Asignar ID de usuario automáticamente si está vacío
                if (empty($model->user_id)) {
                    $model->user_id = Auth::id();
                }
            }
        });
    }

    // Relación con el CBIT
    public function cbit()
    {
        return $this->belongsTo(_c_b_i_t::class, 'cbit_id');
    }

    // Relación con el usuario del sistema
    public function user()
    {
        return $this->belongsTo(usuario_sistema::class, 'user_id');
    }

    // Accessor para saber si está vencido
    public function getEstaVencidoAttribute()
    {
        if ($this->fecha_fin) {
            $fechaFin = \Carbon\Carbon::parse($this->fecha_fin)->endOfDay();
            return now()->greaterThan($fechaFin);
        }
        return !$this->activo;
    }

    // Scope de búsqueda general (opcional pero muy útil)
    public function scopeSearch(Builder $query, ?string $term): void
    {
        $query->when($term, function (Builder $query, string $term) {
            $query->where(function (Builder $query) use ($term) {
                $query->where('nombre', 'like', "%{$term}%")
                      ->orWhere('tipo', 'like', "%{$term}%")
                      ->orWhere('descripcion', 'like', "%{$term}%");
            });
        });
    }
}
