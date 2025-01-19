<?php

namespace Comrades\PhonePackage;

interface CodeSenderInterface
{
    /**
     * Send a code to the specified recipient
     *
     * @param string $phone The recipient of the code (phone number or other identifier)
     * @return string Returns generated code or provided code
     */
    public function sendCode(string $phone): string;
}
