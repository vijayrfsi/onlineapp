<?php
namespace BorgCMS\FluidSchema;
use Illuminate\Support\ServiceProvider;

class FluidSchemaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('fluidschema', function()
        {
            return new FluidSchema();
        });
    }
}
