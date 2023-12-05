<?php

use Modules\CandidateProfiles\Models\CandidateProfile;

uses(Tests\TestCase::class);

test('can see candidateprofile list', function() {
    $this->authenticate();
   $this->get(route('app.candidate_profiles.index'))->assertOk();
});

test('can see candidateprofile create page', function() {
    $this->authenticate();
   $this->get(route('app.candidate_profiles.create'))->assertOk();
});

test('can create candidateprofile', function() {
    $this->authenticate();
   $this->post(route('app.candidate_profiles.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.candidate_profiles.index'));

   $this->assertDatabaseCount('candidate_profiles', 1);
});

test('can see candidateprofile edit page', function() {
    $this->authenticate();
    $candidateprofile = CandidateProfile::factory()->create();
    $this->get(route('app.candidate_profiles.edit', $candidateprofile->id))->assertOk();
});

test('can update candidateprofile', function() {
    $this->authenticate();
    $candidateprofile = CandidateProfile::factory()->create();
    $this->patch(route('app.candidate_profiles.update', $candidateprofile->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.candidate_profiles.index'));

    $this->assertDatabaseHas('candidate_profiles', ['name' => 'Joe Smith']);
});

test('can delete candidateprofile', function() {
    $this->authenticate();
    $candidateprofile = CandidateProfile::factory()->create();
    $this->delete(route('app.candidate_profiles.delete', $candidateprofile->id))->assertRedirect(route('app.candidate_profiles.index'));

    $this->assertDatabaseCount('candidate_profiles', 0);
});