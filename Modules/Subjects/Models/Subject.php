<?php

namespace Modules\Subjects\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subjects\Database\Factories\SubjectFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return SubjectFactory::new();
    }
}
