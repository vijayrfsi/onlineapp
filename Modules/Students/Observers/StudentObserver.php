<?php

namespace Modules\Students\Observers;

use Modules\Students\Models\Student;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     *
     * @param  Modules\Students\Models\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
 
    }

    /**
     * Handle the Student "updated" event.
     *
     * @param  Modules\Students\Models\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     *
     * @param  Modules\Students\Models\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //

    }

    /**
     * Handle the Student "restored" event.
     *
     * @param  Modules\Students\Models\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     *
     * @param  Modules\Students\Models\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
