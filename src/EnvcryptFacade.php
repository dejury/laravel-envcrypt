<?php

namespace Dejury\Envcrypt;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dejury\Envcrypt\Skeleton\SkeletonClass
 */
class EnvcryptFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Envcrypt::class;
    }
}
