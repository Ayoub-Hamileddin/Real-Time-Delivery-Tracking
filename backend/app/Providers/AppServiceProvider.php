<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         # ENABLE THE PASSWORD GRANT
        Passport::enablePasswordGrant();

        #specifiy the expires times of tokens
        Passport::tokensExpireIn(CarbonInterval::minute(60));
        Passport::refreshTokensExpireIn(CarbonInterval::days(30));
        Passport::personalAccessTokensExpireIn(CarbonInterval::months(6));

        #specify passport scopes
        Passport::tokensCan([
            "deliver-orders" => "Update deliver status and location",
            "manage-orders" => "Create and track orders (customer)",
        ]);

        # CUSTOMIZE RESET LINK PASSWORD
        ResetPassword::createUrlUsing(function(object $notifiable , string $token ){
            return 'http://127.0.0.1:8000/api/password-reset/' . $token . '?email=' . $notifiable->getEmailForPasswordReset();
        });
    }
}
