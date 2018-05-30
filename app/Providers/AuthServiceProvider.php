<?php

namespace App\Providers;

use App\Model\UserPermission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = UserPermission::all();

        foreach ($permissions as $permission){
            \Gate::define($permission->name,function ($user) use ($permission){
                return $user->hasPermission($permission);
            });
        }

        //能发言
        \Gate::define('speak',function ($user){
            return $user->isGag;
        });

        //没拉黑
        \Gate::define('friend',function ($user){
            return $user->isDefriend;
        });

    }
}
