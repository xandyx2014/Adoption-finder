<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('is-admin', function($user) {
            return $user->rol->nombre == 'admin';
        });
        Gate::define('no-admin', function($user) {
            return $user->rol->nombre != 'admin';
        });
        Gate::define('permiso', function($user, $permiso) {

                if ($user->rol == null)
                {
                    auth()->logout();
                    redirect('login');
                    return false;
                }

                $auth = $user->rol->permiso;
                if ($user->rol->nombre == 'admin')
                {
                    return true;
                }
                // $user = User::findOrFail(1)->rol->permiso;
                return $permiso = $auth->pluck('nombre')->contains($permiso);




        });
        Gate::define('is-autor', function ($user) {
            return $user->rol->id == 2;
        });
        //
    }
}
