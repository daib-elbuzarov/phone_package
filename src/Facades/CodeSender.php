<?php

namespace Comrades\PhonePackage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string sendCode(string $phone)
 * 
 * @see \Comrades\PhonePackage\CodeSenderInterface
 */
class CodeSender extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'code-sender';
    }
}
