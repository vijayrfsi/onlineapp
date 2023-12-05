<?php

namespace Modules\Classes\Observers;

use Modules\Classes\Models\Class;

class ClassObserver
{
    /**
     * Handle the Class "created" event.
     *
     * @param  Modules\Classes\Models\Class  $class
     * @return void
     */
    public function created(Class $class)
    {
 
    }

    /**
     * Handle the Class "updated" event.
     *
     * @param  Modules\Classes\Models\Class  $class
     * @return void
     */
    public function updated(Class $class)
    {
        //
    }

    /**
     * Handle the Class "deleted" event.
     *
     * @param  Modules\Classes\Models\Class  $class
     * @return void
     */
    public function deleted(Class $class)
    {
        //

    }

    /**
     * Handle the Class "restored" event.
     *
     * @param  Modules\Classes\Models\Class  $class
     * @return void
     */
    public function restored(Class $class)
    {
        //
    }

    /**
     * Handle the Class "force deleted" event.
     *
     * @param  Modules\Classes\Models\Class  $class
     * @return void
     */
    public function forceDeleted(Class $class)
    {
        //
    }
}
