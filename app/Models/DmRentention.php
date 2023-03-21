<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

class DmRentention extends Model
{
    use HasFactory;

        public function file(){
        return $this->belongsTo('App\Models\DmFileUpload', 'file_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }
}
