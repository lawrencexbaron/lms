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
        'section_code',
        'section_description',
        'status',
    ];

    public function adviser()
    {
        return $this->belongsTo(User::class, 'adviser_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_level_id');
    }

    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }
}
