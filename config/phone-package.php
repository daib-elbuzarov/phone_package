<?php

// config for Comrades/PhonePackage
return [
    /**
     * Available: log
     */
    'driver' => env('PHONE_DRIVER', 'log'),

    /**
     * Default user model
     */
    'model' => \App\Models\User::class,

    /**
     * Default phone field in the user model
     */
    'phone_field' => 'phone',
];
