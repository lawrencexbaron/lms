<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school_year()
    {
        return $this->hasOne(SchoolYear::class, 'id', 'school_year_id');
    }
}
