<?php

namespace BorgCMS\FluidSchema;
use Illuminate\Support\Facades\Facade;

class FluidSchemaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fluidschema';
    }
}
