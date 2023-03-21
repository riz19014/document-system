<?php
  
namespace App\Scopes;
  
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
  
class FilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('company_id', Auth::user()->company_id)->where('company_branch_id', Auth::user()->company_branch_id)->where('department_id', Auth::user()->department_id)->where('section_id', Auth::user()->section_id);
    }
}