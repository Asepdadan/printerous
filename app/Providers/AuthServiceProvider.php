<?php

namespace App\Providers;

use App\Models\Organization;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    //protected $policies = [
    //    \App\Model::class => \App\Policies\ModelPolicy::class,
    //];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        //foreach ($this->getPermissions() as $permission){
        //    $gate->define($permission->name , function(User $user) use ($permission){
        //        return $user->hasAnyRole($permission->role()->pluck('name')->toArray());
        //    });
        //}

        $gate->define('create-user' , function(User $user){
            return $user->hasAnyRole(['Administrator']);
        });

        $gate->define('lihat-organization' , function(User $user){
            return $user->hasAnyRole(['Account Manager', 'Staff']);
        });

        $gate->define('create-organization' , function(User $user){
            return $user->hasAnyRole(['Account Manager']);
        });

        $gate->define('create-person' , function(User $user){
            return $user->hasAnyRole(['Account Manager']);
        });
    }

    protected function getPermissions(){
        if (Permission::first()) {
            return Permission::with('role')->get();
        }
    }
}
