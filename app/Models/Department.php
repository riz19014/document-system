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
        'company_id'
    ];

    public function unit(){
        return $this->belongsTo('App\Models\dm_unit', 'unit_id');
    }
    public function company(){
        return $this->belongsTo('App\Models\dm_company', 'company_id');
    }
    public function sections()
    {
        return $this->hasMany('App\Models\Section','department_id', 'id');
    }
}
