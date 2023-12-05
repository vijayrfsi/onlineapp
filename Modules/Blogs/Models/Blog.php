<?php

namespace Modules\Blogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blogs\Database\Factories\BlogFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [''];
    
    protected static function newFactory()
    {
        return BlogFactory::new();
    }
}
