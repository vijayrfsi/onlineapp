<?php

namespace Modules\Degrees\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Degrees\Database\Factories\DegreeFactory;

class Degree extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return DegreeFactory::new();
    }
}
