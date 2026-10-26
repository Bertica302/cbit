<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class PermisoCbit implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (Auth::check()){
        $user = Auth::user();

        if ($user->empleado?->rol_id === 1 || is_null($user->empleado?->_c_b_i_t_id)) {
        return;

        }

        if ($user->empleado?->_c_b_i_t_id){

        $builder->where($model->getTable() . '._c_b_i_t_id', $user->empleado->_c_b_i_t_id);


        }


        }
    }
}
