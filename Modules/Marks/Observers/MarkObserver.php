<?php

namespace Modules\Marks\Observers;

use Modules\Marks\Models\Mark;

class MarkObserver
{
    /**
     * Handle the Mark "created" event.
     *
     * @param  Modules\Marks\Models\Mark  $mark
     * @return void
     */
    public function created(Mark $mark)
    {
 
    }

    /**
     * Handle the Mark "updated" event.
     *
     * @param  Modules\Marks\Models\Mark  $mark
     * @return void
     */
    public function updated(Mark $mark)
    {
        //
    }

    /**
     * Handle the Mark "deleted" event.
     *
     * @param  Modules\Marks\Models\Mark  $mark
     * @return void
     */
    public function deleted(Mark $mark)
    {
        //

    }

    /**
     * Handle the Mark "restored" event.
     *
     * @param  Modules\Marks\Models\Mark  $mark
     * @return void
     */
    public function restored(Mark $mark)
    {
        //
    }

    /**
     * Handle the Mark "force deleted" event.
     *
     * @param  Modules\Marks\Models\Mark  $mark
     * @return void
     */
    public function forceDeleted(Mark $mark)
    {
        //
    }
}
