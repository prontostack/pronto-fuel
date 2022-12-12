<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Parental\HasChildren;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, HasChildren;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'email',
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar($size = 32)
    {
        if (!empty($this->avatar)) {
            return Storage::disk('public')->url($this->avatar);
        }

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mp&s=" . $size;
    }

    public function hasConfirmedPassword()
    {
        return (time() - session()->get('auth.password_confirmed_at', 0)) < request()->input('seconds', config('auth.password_timeout', 900));
    }

    public function mustConfirmTwoFactorAuthentication()
    {
        if (Fortify::confirmsTwoFactorAuthentication()) {
            return !is_null($this->two_factor_secret) &&
                is_null($this->two_factor_confirmed_at);
        }

        return false;
    }

    public function invalidateEmailVerification()
    {
        if (!$this instanceof MustVerifyEmail) {
            return;
        }

        $this->email_verified_at = null;

        $this->save();
    }
}
