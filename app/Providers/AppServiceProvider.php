<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Policies\Api\V1\TicketPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(fn () =>
            Password::min(8)
                ->numbers()
                ->mixedCase()
                ->symbols()
                ->uncompromised()
        );


        Gate::policy(Ticket::class, TicketPolicy::class);



    }
}
