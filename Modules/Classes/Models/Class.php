<?php

namespace Modules\Classes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Classes\Database\Factories\ClassFactory;

class Class extends Model
{
    use HasFactory;

    protected $fillable = [''];
    
    protected static function newFactory()
    {
        return ClassFactory::new();
    }
}
