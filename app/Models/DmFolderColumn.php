<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

class DmFolderColumn extends Model
{
    use HasFactory;

    public function tagname(){
        return $this->belongsTo('App\Models\DmMetaTagging', 'meta_tag_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }
}
