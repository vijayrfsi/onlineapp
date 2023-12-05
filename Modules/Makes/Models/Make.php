<?php

namespace Modules\Makes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Makes\Database\Factories\MakeFactory;

class Make extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return MakeFactory::new();
    }
}
