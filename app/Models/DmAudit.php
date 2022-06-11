<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmAudit extends Model
{
    use HasFactory;


      public function Object(){
        return $this->belongsTo('App\Models\DmSection', 'object_id');
    }

         public function Objectfile(){
        return $this->belongsTo('App\Models\DmFileUpload', 'object_id');
    }

     public function User(){
        return $this->belongsTo('App\Models\User', 'user');
    }
}
