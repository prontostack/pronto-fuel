<?php

namespace App\Rules;

use App\Services\TwoFactorAuth as TwoFactorAuthService;
use Illuminate\Contracts\Validation\InvokableRule;

class TwoFactorAuth implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!(new TwoFactorAuthService)->validateInput($value)) {
            $fail('The :attribute is invalid.');
        }
    }
}
