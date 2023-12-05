<?php

namespace Modules\Marks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Marks\Database\Factories\MarkFactory;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return MarkFactory::new();
    }
}
