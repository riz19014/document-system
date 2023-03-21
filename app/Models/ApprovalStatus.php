<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

class ApprovalStatus extends Model
{
    use HasFactory;
    protected $dates = ['approval_date'];

        public function file(){
        return $this->belongsTo('App\Models\DmFileUpload', 'file_id');
    }

     public function UserName(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }
}
