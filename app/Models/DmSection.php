<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;

class DmSection extends Model
{
    use HasFactory;

    public function parent(){
        return $this->belongsTo('App\Models\DmSection', 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany('App\Models\DmSection', 'parent_id', 'id');
    }

 public function FolderName(){
        return $this->hasMany('App\Models\DmFileUpload', 'folder_id');
    }

  public function scopeWhereLike($query, $column, $value){
		return $query->where($column, 'like', '%'.$value.'%');
	}

    public function metatagfolder(){
        return $this->hasMany('App\Models\DmFileTagging', 'folder_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }



}
