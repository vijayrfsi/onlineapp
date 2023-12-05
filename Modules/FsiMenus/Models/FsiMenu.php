<?php

namespace Modules\FsiMenus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\FsiMenus\Database\Factories\FsiMenuFactory;

class FsiMenu extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return FsiMenuFactory::new();
    }
}
