<?php

namespace Modules\Districts\Observers;

use Modules\Districts\Models\District;

class DistrictObserver
{
    /**
     * Handle the District "created" event.
     *
     * @param  Modules\Districts\Models\District  $district
     * @return void
     */
    public function created(District $district)
    {
 
    }

    /**
     * Handle the District "updated" event.
     *
     * @param  Modules\Districts\Models\District  $district
     * @return void
     */
    public function updated(District $district)
    {
        //
    }

    /**
     * Handle the District "deleted" event.
     *
     * @param  Modules\Districts\Models\District  $district
     * @return void
     */
    public function deleted(District $district)
    {
        //

    }

    /**
     * Handle the District "restored" event.
     *
     * @param  Modules\Districts\Models\District  $district
     * @return void
     */
    public function restored(District $district)
    {
        //
    }

    /**
     * Handle the District "force deleted" event.
     *
     * @param  Modules\Districts\Models\District  $district
     * @return void
     */
    public function forceDeleted(District $district)
    {
        //
    }
}
