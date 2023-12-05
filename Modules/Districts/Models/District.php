<?php

namespace Modules\Districts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Districts\Database\Factories\DistrictFactory;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected static function newFactory()
    {
        return DistrictFactory::new();
    }
}
