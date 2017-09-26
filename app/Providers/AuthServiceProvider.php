<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('addNewArticle',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('addImage',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('updateArticle',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('deleteArticle',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('deleteComment',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('deleteUser',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('admin',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('user',function ($user){
            return $user->login == AUTH_USER;
        });

        $gate->define('article',function ($user){
            return $user->login == AUTH_USER;
        });
        $gate->define('moder',function ($user){
            return $user->login == AUTH_MODER;
        });
    }

}
