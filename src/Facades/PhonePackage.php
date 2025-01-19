<?php

namespace Comrades\PhonePackage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Comrades\PhonePackage\PhonePackage
 */
class PhonePackage extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Comrades\PhonePackage\PhonePackage::class;
    }
}
