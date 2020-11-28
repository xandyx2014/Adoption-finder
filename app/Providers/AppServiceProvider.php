<?php

namespace App\Providers;

use App\Models\Permiso;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
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
        Paginator::useBootstrap();
        /*Blade::if('has', function ($permiso) {
            $user = auth()->user()->rol->permiso;
            // $user = User::findOrFail(1)->rol->permiso;
            return $permiso = $user->pluck('nombre')->contains($permiso);
        });*/
    }
}
