<?php

namespace Modules\Semesters\Observers;

use Modules\Semesters\Models\Semester;

class SemesterObserver
{
    /**
     * Handle the Semester "created" event.
     *
     * @param  Modules\Semesters\Models\Semester  $semester
     * @return void
     */
    public function created(Semester $semester)
    {
 
    }

    /**
     * Handle the Semester "updated" event.
     *
     * @param  Modules\Semesters\Models\Semester  $semester
     * @return void
     */
    public function updated(Semester $semester)
    {
        //
    }

    /**
     * Handle the Semester "deleted" event.
     *
     * @param  Modules\Semesters\Models\Semester  $semester
     * @return void
     */
    public function deleted(Semester $semester)
    {
        //

    }

    /**
     * Handle the Semester "restored" event.
     *
     * @param  Modules\Semesters\Models\Semester  $semester
     * @return void
     */
    public function restored(Semester $semester)
    {
        //
    }

    /**
     * Handle the Semester "force deleted" event.
     *
     * @param  Modules\Semesters\Models\Semester  $semester
     * @return void
     */
    public function forceDeleted(Semester $semester)
    {
        //
    }
}
