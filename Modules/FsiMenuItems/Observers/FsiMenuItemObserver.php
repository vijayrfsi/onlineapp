<?php

namespace Modules\FsiMenuItems\Observers;

use Modules\FsiMenuItems\Models\FsiMenuItem;

class FsiMenuItemObserver
{
    /**
     * Handle the FsiMenuItem "created" event.
     *
     * @param  Modules\FsiMenuItems\Models\FsiMenuItem  $fsimenuitem
     * @return void
     */
    public function created(FsiMenuItem $fsimenuitem)
    {
        
    }

    /**
     * Handle the FsiMenuItem "updated" event.
     *
     * @param  Modules\FsiMenuItems\Models\FsiMenuItem  $fsimenuitem
     * @return void
     */
    public function updated(FsiMenuItem $fsimenuitem)
    {
        //
    }

    /**
     * Handle the FsiMenuItem "deleted" event.
     *
     * @param  Modules\FsiMenuItems\Models\FsiMenuItem  $fsimenuitem
     * @return void
     */
    public function deleted(FsiMenuItem $fsimenuitem)
    {
        //

    }

    /**
     * Handle the FsiMenuItem "restored" event.
     *
     * @param  Modules\FsiMenuItems\Models\FsiMenuItem  $fsimenuitem
     * @return void
     */
    public function restored(FsiMenuItem $fsimenuitem)
    {
        //
    }

    /**
     * Handle the FsiMenuItem "force deleted" event.
     *
     * @param  Modules\FsiMenuItems\Models\FsiMenuItem  $fsimenuitem
     * @return void
     */
    public function forceDeleted(FsiMenuItem $fsimenuitem)
    {
        //
    }
}
