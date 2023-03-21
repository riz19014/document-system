<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dm_company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name'
    ];
     
    public function units()
    {
        return $this->hasMany('App\Models\dm_unit','company_id', 'id');
    }
    

}
