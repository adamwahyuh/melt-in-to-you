<?php

namespace App\Providers;

use App\Models\Peran;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        Gate::define('kasir', function(User $user){
            return $user->peran()->where('name', 'kasir')->exists();
        });
        Gate::define('stocker', function(User $user){
            return $user->peran()->where('name', 'stocker')->exists();
        });
        Gate::define('owner', function(User $user){
            return $user->peran()->where('name', 'owner')->exists();
        });
    }
}
