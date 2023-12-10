<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'grade_level_id');
    }
}
