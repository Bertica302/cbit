<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index(){

    $activities = Activity::with(['causer', 'subject'])
    ->latest()
    ->paginate(5);

    return view('auditorias.index', compact('activities'));

    }
}
