<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

class DmMetaTagging extends Model
{
    use HasFactory;


    public function tagstatus(){
        return $this->hasMany('App\Models\DmFolderColumn', 'meta_tag_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }

 
}
