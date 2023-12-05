<?php

namespace Modules\CandidateProfiles\Observers;

use Modules\CandidateProfiles\Models\CandidateProfile;

class CandidateProfileObserver
{
    /**
     * Handle the CandidateProfile "created" event.
     *
     * @param  Modules\CandidateProfiles\Models\CandidateProfile  $candidateprofile
     * @return void
     */
    public function created(CandidateProfile $candidateprofile)
    {
 
    }

    /**
     * Handle the CandidateProfile "updated" event.
     *
     * @param  Modules\CandidateProfiles\Models\CandidateProfile  $candidateprofile
     * @return void
     */
    public function updated(CandidateProfile $candidateprofile)
    {
        //
    }

    /**
     * Handle the CandidateProfile "deleted" event.
     *
     * @param  Modules\CandidateProfiles\Models\CandidateProfile  $candidateprofile
     * @return void
     */
    public function deleted(CandidateProfile $candidateprofile)
    {
        //

    }

    /**
     * Handle the CandidateProfile "restored" event.
     *
     * @param  Modules\CandidateProfiles\Models\CandidateProfile  $candidateprofile
     * @return void
     */
    public function restored(CandidateProfile $candidateprofile)
    {
        //
    }

    /**
     * Handle the CandidateProfile "force deleted" event.
     *
     * @param  Modules\CandidateProfiles\Models\CandidateProfile  $candidateprofile
     * @return void
     */
    public function forceDeleted(CandidateProfile $candidateprofile)
    {
        //
    }
}
