<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmMetaTagging extends Model
{
    use HasFactory;


    public function tagstatus(){
        return $this->hasMany('App\Models\DmFolderColumn', 'meta_tag_id');
    }

 
}
