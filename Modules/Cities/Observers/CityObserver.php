<?php

namespace Modules\Cities\Observers;

use Modules\Cities\Models\City;

class CityObserver
{
    /**
     * Handle the City "created" event.
     *
     * @param  Modules\Cities\Models\City  $city
     * @return void
     */
    public function created(City $city)
    {
 
    }

    /**
     * Handle the City "updated" event.
     *
     * @param  Modules\Cities\Models\City  $city
     * @return void
     */
    public function updated(City $city)
    {
        //
    }

    /**
     * Handle the City "deleted" event.
     *
     * @param  Modules\Cities\Models\City  $city
     * @return void
     */
    public function deleted(City $city)
    {
        //

    }

    /**
     * Handle the City "restored" event.
     *
     * @param  Modules\Cities\Models\City  $city
     * @return void
     */
    public function restored(City $city)
    {
        //
    }

    /**
     * Handle the City "force deleted" event.
     *
     * @param  Modules\Cities\Models\City  $city
     * @return void
     */
    public function forceDeleted(City $city)
    {
        //
    }
}
