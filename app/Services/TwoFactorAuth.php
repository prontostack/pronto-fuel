<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Google2FA;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuth
{
    private $storage = 'session';
    private $storageKey = 'two_factor_auth_secret';
    private $secretKey;
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function qrCode()
    {
        return $this->getInlineUrl();
    }

    private function getInlineUrl()
    {
        return Google2FA::getQRCodeInline(
            $this->user->name,
            $this->user->email,
            $this->getSecretKey()
        );
    }

    public function getSecretKey()
    {
        if (!$key = $this->getStoredKey()) {
            $key = Google2FA::generateSecretKey();

            $this->storeKey($key);
        }

        return $key;
    }

    public function getStoredKey()
    {
        // No need to read it from disk it again if we already have it
        if ($this->secretKey) {
            return $this->secretKey;
        }

        if ($this->storage === 'session') {
            if (!Session::has($this->storageKey)) {
                return null;
            }

            return Session::get($this->storageKey);
        }
    }

    public function storeKey($key)
    {
        if ($this->storage === 'session') {
            Session::put($this->storageKey, $key);
        }
    }

    public function validateInput($input)
    {
        return Google2FA::verifyKey($this->getSecretKey(), (string) $input);
    }
}
