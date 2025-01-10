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

    public function numbering()
    {
        return $this->hasOne(DmNumbering::class, 'entity_id')->where('entity_type', 2); // Adjust entity_type as needed
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }
}
