<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\builder;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivityConChanges;

class Asistencias extends Model
{
    use HasFactory, SoftDeletes, LogsActivityConChanges;
    protected $fillable = [
        'usuario_id',
        'cbit_id',
        'foto',
        'observacion',
        'actividad',
        'created_at',];
    //



}
