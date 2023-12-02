<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];    

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_level_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function parent()
    {
        return $this->hasOne(StudentParent::class, 'student_id');
    }
    public function address()
    {
        return $this->hasOne(StudentAddress::class, 'student_id');
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'student_modules', 'student_id', 'module_id');
    }
}
