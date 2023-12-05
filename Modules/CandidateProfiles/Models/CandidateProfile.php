<?php

namespace Modules\CandidateProfiles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CandidateProfiles\Database\Factories\CandidateProfileFactory;

class CandidateProfile extends Model
{
    use HasFactory;

    protected $fillable = [''];
    
    protected static function newFactory()
    {
        return CandidateProfileFactory::new();
    }
}
