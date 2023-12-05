<?php

namespace Modules\Semesters\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Semesters\Database\Factories\SemesterFactory;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return SemesterFactory::new();
    }
}
