<?php

namespace Modules\States\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\States\Database\Factories\StateFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = [''];
    
    protected static function newFactory()
    {
        return StateFactory::new();
    }
}
