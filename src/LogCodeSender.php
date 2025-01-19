<?php

namespace Comrades\PhonePackage;

use Illuminate\Support\Facades\Log;

class LogCodeSender implements CodeSenderInterface
{
    private int $codeLength;

    public function __construct(int $codeLength = 6)
    {
        $this->codeLength = $codeLength;
    }

    public function sendCode(string $phone): string
    {
        $code = $this->generateCode();
        
        Log::info('Generated code for phone', [
            'phone' => $phone,
            'code' => $code
        ]);

        return $code;
    }

    private function generateCode(): string
    {
        return str_pad(
            (string) random_int(0, pow(10, $this->codeLength) - 1),
            $this->codeLength,
            '0',
            STR_PAD_LEFT
        );
    }
}
