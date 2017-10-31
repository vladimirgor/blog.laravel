<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Priv;
use App\Role;
use App\PrivForRole;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
   // protected $policies = [
   //     'App\Model' => 'App\Policies\ModelPolicy',
   // ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        $gate->define('access',function ($user,$privilege){
            //Checking access to the privilege by Eloquent
            $can = Role::find($user->role_id)->privs()->where('name',$privilege)->get();
            return  !$can->isEmpty();
        });
    }
}
