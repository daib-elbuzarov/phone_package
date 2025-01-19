<?php

namespace Comrades\PhonePackage\Commands;

use Illuminate\Console\Command;

class PhonePackageCommand extends Command
{
    public $signature = 'phone-package';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
