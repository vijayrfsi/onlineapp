<?php

namespace Modules\Departments\Observers;

use Modules\Departments\Models\Department;

class DepartmentObserver
{
    /**
     * Handle the Department "created" event.
     *
     * @param  Modules\Departments\Models\Department  $department
     * @return void
     */
    public function created(Department $department)
    {
 
    }

    /**
     * Handle the Department "updated" event.
     *
     * @param  Modules\Departments\Models\Department  $department
     * @return void
     */
    public function updated(Department $department)
    {
        //
    }

    /**
     * Handle the Department "deleted" event.
     *
     * @param  Modules\Departments\Models\Department  $department
     * @return void
     */
    public function deleted(Department $department)
    {
        //

    }

    /**
     * Handle the Department "restored" event.
     *
     * @param  Modules\Departments\Models\Department  $department
     * @return void
     */
    public function restored(Department $department)
    {
        //
    }

    /**
     * Handle the Department "force deleted" event.
     *
     * @param  Modules\Departments\Models\Department  $department
     * @return void
     */
    public function forceDeleted(Department $department)
    {
        //
    }
}
