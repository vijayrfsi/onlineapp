<?php

namespace Modules\States\Observers;

use Modules\States\Models\State;

class StateObserver
{
    /**
     * Handle the State "created" event.
     *
     * @param  Modules\States\Models\State  $state
     * @return void
     */
    public function created(State $state)
    {
 
    }

    /**
     * Handle the State "updated" event.
     *
     * @param  Modules\States\Models\State  $state
     * @return void
     */
    public function updated(State $state)
    {
        //
    }

    /**
     * Handle the State "deleted" event.
     *
     * @param  Modules\States\Models\State  $state
     * @return void
     */
    public function deleted(State $state)
    {
        //

    }

    /**
     * Handle the State "restored" event.
     *
     * @param  Modules\States\Models\State  $state
     * @return void
     */
    public function restored(State $state)
    {
        //
    }

    /**
     * Handle the State "force deleted" event.
     *
     * @param  Modules\States\Models\State  $state
     * @return void
     */
    public function forceDeleted(State $state)
    {
        //
    }
}
