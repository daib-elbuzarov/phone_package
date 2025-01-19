<?php

namespace Comrades\PhonePackage;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Comrades\PhonePackage\Commands\PhonePackageCommand;
use Comrades\PhonePackage\Contracts\CodeSenderInterface;
use Comrades\PhonePackage\Factories\CodeSenderFactory;

class PhonePackageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('phone-package')
            ->hasConfigFile()
            ->hasRoute('api')
            ->hasCommand(PhonePackageCommand::class);
    }

    public function boot()
    {
        parent::boot();

        $this->app->bind(CodeSenderInterface::class, function ($app) {
            return CodeSenderFactory::create();
        });
    }
}
