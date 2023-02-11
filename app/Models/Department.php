<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit_id',
        'company_id',
        'company_branch_id'
    ];

    public function unit(){
        return $this->belongsTo('App\Models\dm_unit', 'unit_id');
    }
}
