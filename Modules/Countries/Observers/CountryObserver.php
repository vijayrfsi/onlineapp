<?php

namespace Modules\Countries\Observers;

use Modules\Countries\Models\Country;

class CountryObserver
{
    /**
     * Handle the Country "created" event.
     *
     * @param  Modules\Countries\Models\Country  $country
     * @return void
     */
    public function created(Country $country)
    {
 
    }

    /**
     * Handle the Country "updated" event.
     *
     * @param  Modules\Countries\Models\Country  $country
     * @return void
     */
    public function updated(Country $country)
    {
        //
    }

    /**
     * Handle the Country "deleted" event.
     *
     * @param  Modules\Countries\Models\Country  $country
     * @return void
     */
    public function deleted(Country $country)
    {
        //

    }

    /**
     * Handle the Country "restored" event.
     *
     * @param  Modules\Countries\Models\Country  $country
     * @return void
     */
    public function restored(Country $country)
    {
        //
    }

    /**
     * Handle the Country "force deleted" event.
     *
     * @param  Modules\Countries\Models\Country  $country
     * @return void
     */
    public function forceDeleted(Country $country)
    {
        //
    }
}
