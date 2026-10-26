<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Spatie\Activitylog\Facades\Activity as FacadesActivity;

class AuditoriaController extends Controller
{
    public function index(){

    $activities = Activity::with(['causer', 'subject'])
    ->latest()
    ->paginate(5);

    return view('auditorias.index', compact('activities'));

    }



    public function show($id){

    $activity = Activity::findOrFail($id);
    return view('auditorias.show', compact('activity'));


    }
}
