<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmFolderColumn extends Model
{
    use HasFactory;

    public function tagname(){
        return $this->belongsTo('App\Models\DmMetaTagging', 'meta_tag_id');
    }
}
