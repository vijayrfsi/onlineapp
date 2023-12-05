<?php
namespace Modules\CandidateProfiles\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\CandidateProfiles\Models\CandidateProfile;

class CandidateProfileFactory extends Factory
{
    protected $model = CandidateProfile::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}