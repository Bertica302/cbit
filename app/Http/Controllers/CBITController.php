<?php

namespace App\Http\Controllers;

use App\Models\_c_b_i_t;
use Illuminate\Http\Request;

class CBITController extends Controller
{
    public function index()
    {
        $cbits = _c_b_i_t::query()
            ->with('parroquia')
            ->orderBy('nombre')
            ->get();

        return view('CBIT.index', compact('cbits'));
    }

    public function show(_c_b_i_t $cbit)
    {
        $cbit->load(['parroquia', 'empleado']);

        return view('CBIT.show', compact('cbit'));
    }
}
