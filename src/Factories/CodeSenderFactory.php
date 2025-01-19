<?php

namespace Comrades\PhonePackage\Factories;

use Comrades\PhonePackage\CodeSenderInterface;
use Comrades\PhonePackage\LogCodeSender;
use InvalidArgumentException;

class CodeSenderFactory
{
    public static function create(?string $driver = null): CodeSenderInterface
    {
        $driver = $driver ?? config('phone-package.driver', 'log');

        return match ($driver) {
            'log' => new LogCodeSender(),
            default => throw new InvalidArgumentException("Driver [{$driver}] not supported."),
        };
    }
}
