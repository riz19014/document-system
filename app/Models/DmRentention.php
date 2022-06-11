<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmRentention extends Model
{
    use HasFactory;

          public function file(){
        return $this->belongsTo('App\Models\DmFileUpload', 'file_id');
    }
}
