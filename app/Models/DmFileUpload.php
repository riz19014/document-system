<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

class DmFileUpload extends Model
{
    use HasFactory;
    

     public function foldername(){

        return $this->belongsTo('App\Models\DmSection', 'folder_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }
}
