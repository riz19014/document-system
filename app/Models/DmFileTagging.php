<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

class DmFileTagging extends Model
{
    use HasFactory;

     public function metaname(){
        return $this->belongsTo('App\Models\DmMetaTagging', 'meta_tag_id');
    }

    public function filename(){
        return $this->belongsTo('App\Models\DmFileUpload', 'file_scan_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }
}
