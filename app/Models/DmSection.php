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

    public function grandchildren()
    {
        // Get all children and then recursively fetch their children (grandchildren)
        $grandchildren = collect();

        foreach ($this->children as $child) {
            $grandchildren = $grandchildren->merge($child->children);
        }

        return $grandchildren;
    }

     public function FolderName()
     {
            return $this->hasMany('App\Models\DmFileUpload', 'folder_id');
     }

     public function allDescendants()
    {
        $descendants = collect();

        // Fetch direct children
        foreach ($this->children as $child) {
            $descendants->push($child);

            // Recursively fetch their descendants
            $descendants = $descendants->merge($child->allDescendants());
        }

        return $descendants;
    }

    public function countAllFiles()
    {
        $fileCount = $this->FolderName()->count(); // Files in this folder

        // Fetch all descendant folders and count their files
        foreach ($this->allDescendants() as $descendant) {
            $fileCount += $descendant->FolderName()->count();
        }

        return $fileCount;
    }
    



  public function scopeWhereLike($query, $column, $value){
		return $query->where($column, 'like', '%'.$value.'%');
	}

    public function metatagfolder(){
        return $this->hasMany('App\Models\DmFileTagging', 'folder_id');
    }


    public function numbering()
    {
        return $this->hasOne(DmNumbering::class, 'entity_id')->where('entity_type', 1); // Adjust entity_type as needed
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FilterScope);
    }






}
