<?php

namespace Comrades\PhonePackage;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Comrades\PhonePackage\Commands\PhonePackageCommand;

class PhonePackageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('phone-package')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_phone_package_table')
            ->hasCommand(PhonePackageCommand::class);
    }
}
