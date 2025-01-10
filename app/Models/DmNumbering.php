<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmNumbering extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'entity_type',
        'numbering',
        'company_id',
        'company_branch_id',
        'department_id',
        'section_id',
    ];

}
