<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModule extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // redeclare the modules with display name
    const MODULES_DISPLAY = [
        1 => 'Modular (Printed)',
        2 => 'Modular (Digital)',
        3 => 'Online',
        4 => 'Educational Television',
        5 => 'Radio-based Instruction',
        6 => 'Blended',
        7 => 'Face to Face',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // how to access the display names of modules
    public function getModuleDisplayAttribute()
    {
        return self::MODULES_DISPLAY[$this->module_id];
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

}
