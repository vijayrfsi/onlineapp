<?php

namespace Modules\Countries\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Countries\Database\Factories\CountryFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [''];
    
    protected static function newFactory()
    {
        return CountryFactory::new();
    }
}
