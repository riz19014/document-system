<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmFileUpload extends Model
{
    use HasFactory;
    

     public function foldername(){

        return $this->belongsTo('App\Models\DmSection', 'folder_id');
    }
}
