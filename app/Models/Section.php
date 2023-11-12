<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'adviser_id',
        'grade_level_id',
        'school_year_id',
        'semester_id',
        'section_code',
        'section_description',
    ];
}
