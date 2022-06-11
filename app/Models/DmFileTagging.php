<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmFileTagging extends Model
{
    use HasFactory;

     public function metaname(){
        return $this->belongsTo('App\Models\DmMetaTagging', 'meta_tag_id');
    }

    public function filename(){
        return $this->belongsTo('App\Models\DmFileUpload', 'file_scan_id');
    }
}
