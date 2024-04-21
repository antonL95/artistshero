<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

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
        Gate::define('viewPulse', static fn (User $user) => $user->isAdmin());

        Model::unguard();
        TallStackUi::personalize()->modal()
            ->block('wrapper.fourth', 'dark:bg-dark-700 relative flex w-full transform flex-col bg-white text-left shadow-xl transition-all')
            ->block('body', 'dark:text-dark-300 grow py-5 text-gray-700 px-4');
    }
}
