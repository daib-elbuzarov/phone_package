<?php

namespace Comrades\PhonePackage\Http\Controllers;

use Comrades\PhonePackage\Factories\CodeSenderFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;

class PhoneController
{
    public function send(Request $request): JsonResponse
    {
        $request->validate([
            'phone' => ['required', 'phone:AUTO']
        ]);

        $phone = $this->cleanPhoneNumber($request->input('phone'));
        $code = CodeSenderFactory::create()->sendCode($phone);
        
        $hash = Str::random(32);
        Cache::put("phone_verification:{$hash}", [
            'code' => $code,
            'phone' => $phone
        ], now()->addMinutes(5));

        return response()->json([
            'hash' => $hash
        ]);
    }

    public function confirm(Request $request): JsonResponse
    {
        $request->validate([
            'hash' => 'required|string',
            'code' => 'required|string'
        ]);

        $hash = $request->input('hash');
        $code = $request->input('code');
        
        $data = Cache::get("phone_verification:{$hash}");
        
        if (!$data || $data['code'] !== $code) {
            return response()->json([
                'message' => 'Invalid code'
            ], 422);
        }

        Cache::forget("phone_verification:{$hash}");

        // Get the user model class from config
        $userModel = config('phone-package.model');
        $phoneField = config('phone-package.phone_field', 'phone');

        // Find or create user
        $user = $userModel::firstOrCreate([
            $phoneField => $data['phone']
        ]);

        // Create token
        $token = $user->createToken('phone-auth')->plainTextToken;

        return response()->json([
            'message' => 'Code verified successfully',
            'token' => $token,
            'user' => $user
        ]);
    }

    private function cleanPhoneNumber(string $phone): string
    {
        try {
            // Используем библиотеку для форматирования номера
            return (string) PhoneNumber::make($phone);
        } catch (\Exception $e) {
            // Если что-то пошло не так, используем базовую очистку
            $cleaned = preg_replace('/[^0-9+]/', '', $phone);
            
            if (str_contains($cleaned, '+')) {
                $cleaned = '+' . str_replace('+', '', $cleaned);
            }
            
            return $cleaned;
        }
    }
}
