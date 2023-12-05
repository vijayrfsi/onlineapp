<?php

namespace Modules\Brands\Observers;

use Modules\Brands\Models\Brand;

class BrandObserver
{
    /**
     * Handle the Brand "created" event.
     *
     * @param  Modules\Brands\Models\Brand  $brand
     * @return void
     */
    public function created(Brand $brand)
    {
 
    }

    /**
     * Handle the Brand "updated" event.
     *
     * @param  Modules\Brands\Models\Brand  $brand
     * @return void
     */
    public function updated(Brand $brand)
    {
        //
    }

    /**
     * Handle the Brand "deleted" event.
     *
     * @param  Modules\Brands\Models\Brand  $brand
     * @return void
     */
    public function deleted(Brand $brand)
    {
        //

    }

    /**
     * Handle the Brand "restored" event.
     *
     * @param  Modules\Brands\Models\Brand  $brand
     * @return void
     */
    public function restored(Brand $brand)
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     *
     * @param  Modules\Brands\Models\Brand  $brand
     * @return void
     */
    public function forceDeleted(Brand $brand)
    {
        //
    }
}
