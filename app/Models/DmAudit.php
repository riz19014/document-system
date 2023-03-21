<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

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

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }
}
