<?php

namespace Modules\Degrees\Observers;

use Modules\Degrees\Models\Degree;

class DegreeObserver
{
    /**
     * Handle the Degree "created" event.
     *
     * @param  Modules\Degrees\Models\Degree  $degree
     * @return void
     */
    public function created(Degree $degree)
    {
 
    }

    /**
     * Handle the Degree "updated" event.
     *
     * @param  Modules\Degrees\Models\Degree  $degree
     * @return void
     */
    public function updated(Degree $degree)
    {
        //
    }

    /**
     * Handle the Degree "deleted" event.
     *
     * @param  Modules\Degrees\Models\Degree  $degree
     * @return void
     */
    public function deleted(Degree $degree)
    {
        //

    }

    /**
     * Handle the Degree "restored" event.
     *
     * @param  Modules\Degrees\Models\Degree  $degree
     * @return void
     */
    public function restored(Degree $degree)
    {
        //
    }

    /**
     * Handle the Degree "force deleted" event.
     *
     * @param  Modules\Degrees\Models\Degree  $degree
     * @return void
     */
    public function forceDeleted(Degree $degree)
    {
        //
    }
}
