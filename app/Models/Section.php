<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit_id',
        'company_id',
        'department_id'
    ];

    public function unit(){
        return $this->belongsTo('App\Models\dm_unit', 'unit_id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
}
