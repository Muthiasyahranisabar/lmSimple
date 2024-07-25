<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        //
        Gate::define('isAdmin', function (User $user ) {
            return $user->role === 'admin' ? Response::allow()
                 : Response::deny('Anda Bukan administrator');
        });

        Gate::define('isAuthor', function (User $user ) {
            return $user->role === 'author' ? Response::allow()
                 : Response::deny('Anda Bukan User');
        });

        Gate::define('isEditor', function (User $user ) {
            return $user->role === 'editor' ? Response::allow()
                 : Response::deny('Anda Bukan editor');
        });
    }
}
