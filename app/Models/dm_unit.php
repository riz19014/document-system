<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dm_unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_name',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo('App\Models\dm_company', 'company_id');
    }

}
