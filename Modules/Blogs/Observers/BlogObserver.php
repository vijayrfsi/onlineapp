<?php

namespace Modules\Blogs\Observers;

use Modules\Blogs\Models\Blog;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     *
     * @param  Modules\Blogs\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog)
    {
 
    }

    /**
     * Handle the Blog "updated" event.
     *
     * @param  Modules\Blogs\Models\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        //
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  Modules\Blogs\Models\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
        //

    }

    /**
     * Handle the Blog "restored" event.
     *
     * @param  Modules\Blogs\Models\Blog  $blog
     * @return void
     */
    public function restored(Blog $blog)
    {
        //
    }

    /**
     * Handle the Blog "force deleted" event.
     *
     * @param  Modules\Blogs\Models\Blog  $blog
     * @return void
     */
    public function forceDeleted(Blog $blog)
    {
        //
    }
}
