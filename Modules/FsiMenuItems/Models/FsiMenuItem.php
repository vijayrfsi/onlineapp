<?php

namespace Modules\FsiMenuItems\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\FsiMenuItems\Database\Factories\FsiMenuItemFactory;

class FsiMenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['name','fsi_menu_id','parent_id','icon_name','icon_text','weight','has_children'];
    
    protected static function newFactory()
    {
        return FsiMenuItemFactory::new();
    }
}
