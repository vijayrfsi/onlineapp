<?php

namespace Modules\Subjects\Observers;

use Modules\Subjects\Models\Subject;

class SubjectObserver
{
    /**
     * Handle the Subject "created" event.
     *
     * @param  Modules\Subjects\Models\Subject  $subject
     * @return void
     */
    public function created(Subject $subject)
    {
 
    }

    /**
     * Handle the Subject "updated" event.
     *
     * @param  Modules\Subjects\Models\Subject  $subject
     * @return void
     */
    public function updated(Subject $subject)
    {
        //
    }

    /**
     * Handle the Subject "deleted" event.
     *
     * @param  Modules\Subjects\Models\Subject  $subject
     * @return void
     */
    public function deleted(Subject $subject)
    {
        //

    }

    /**
     * Handle the Subject "restored" event.
     *
     * @param  Modules\Subjects\Models\Subject  $subject
     * @return void
     */
    public function restored(Subject $subject)
    {
        //
    }

    /**
     * Handle the Subject "force deleted" event.
     *
     * @param  Modules\Subjects\Models\Subject  $subject
     * @return void
     */
    public function forceDeleted(Subject $subject)
    {
        //
    }
}
