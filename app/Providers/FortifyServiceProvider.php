<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Forms\Auth\EmailVerificationForm;
use App\Forms\Auth\ForgotPasswordForm;
use App\Forms\Auth\LoginForm;
use App\Forms\Auth\PasswordConfirmationForm;
use App\Forms\Auth\PasswordResetForm;
use App\Forms\Auth\RegistrationForm;
use App\Forms\Auth\TwoFactorChallengeForm;
use App\Forms\Auth\TwoFactorRecoveryForm;
use App\Responses\Fortify\PasswordConfirmedResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\PasswordConfirmedResponse as PasswordConfirmedResponseContract;
use Laravel\Fortify\Fortify;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(PasswordConfirmedResponseContract::class, PasswordConfirmedResponse::class);

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return Inertia::render('Auth/Login', [
                'form' => LoginForm::make()
            ]);
        });

        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::render('Auth/ForgotPassword', [
                'form' => ForgotPasswordForm::make()
            ]);
        });

        Fortify::resetPasswordView(function () {
            return Inertia::render('Auth/ResetPassword', [
                'form' => PasswordResetForm::make()
            ]);
        });

        Fortify::registerView(function () {
            return Inertia::render('Auth/Register', [
                'form' => RegistrationForm::make()
            ]);
        });

        Fortify::verifyEmailView(function () {
            return Inertia::render('Auth/VerifyEmail', [
                'form' => EmailVerificationForm::make()
            ]);
        });

        Fortify::twoFactorChallengeView(function () {
            return Inertia::render('Auth/TwoFactorChallenge', [
                'challengeForm' => TwoFactorChallengeForm::make()->hideSubmit(),
                'recoveryForm' => TwoFactorRecoveryForm::make()
            ]);
        });

        Fortify::confirmPasswordView(function () {
            return Inertia::render('Auth/ConfirmPassword', [
                'form' => PasswordConfirmationForm::make()
            ]);
        });
    }
}
