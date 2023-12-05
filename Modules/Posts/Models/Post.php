<?php

namespace Modules\Posts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Posts\Database\Factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','form__company_name','f4c137fa44','form_message','form_botcheck'];
    
    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
