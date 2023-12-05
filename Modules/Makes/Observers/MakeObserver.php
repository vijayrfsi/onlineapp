<?php

namespace Modules\Makes\Observers;

use Modules\Makes\Models\Make;

class MakeObserver
{
    /**
     * Handle the Make "created" event.
     *
     * @param  Modules\Makes\Models\Make  $make
     * @return void
     */
    public function created(Make $make)
    {
 
    }

    /**
     * Handle the Make "updated" event.
     *
     * @param  Modules\Makes\Models\Make  $make
     * @return void
     */
    public function updated(Make $make)
    {
        //
    }

    /**
     * Handle the Make "deleted" event.
     *
     * @param  Modules\Makes\Models\Make  $make
     * @return void
     */
    public function deleted(Make $make)
    {
        //

    }

    /**
     * Handle the Make "restored" event.
     *
     * @param  Modules\Makes\Models\Make  $make
     * @return void
     */
    public function restored(Make $make)
    {
        //
    }

    /**
     * Handle the Make "force deleted" event.
     *
     * @param  Modules\Makes\Models\Make  $make
     * @return void
     */
    public function forceDeleted(Make $make)
    {
        //
    }
}
