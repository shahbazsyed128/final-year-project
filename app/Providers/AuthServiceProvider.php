<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('isAdmin',function($user){
            return $user->role == 'admin';
        });

        Gate::define('isUser',function($user){
            return $user->role == 'user';
        });

        Gate::define('isMentor', function($user) {
            if($user->role == 'user'){
                return Auth::user()->user_succeed_courses()->get()->count();
            } else if($user->role == 'admin') {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('isCompany',function($user){
            return $user->role == 'company';
        });
    }
}
