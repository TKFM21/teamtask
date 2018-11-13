<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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

        // 開発者のみ許可
        Gate::define('system-only', function ($user) {
            return ($user->role == 1);
        });
        // 管理者以上（管理者＆システム管理者）に許可
        Gate::define('admin-higher', function ($user) {
            return ($user->role > 0 && $user->role <= 3);
        });
        // タスクの削除・登録・編集・閲覧を許可
        Gate::define('crud-higher', function ($user) {
            return ($user->role > 0 && $user->role <= 5);
        });
        // タスクの登録・編集・閲覧を許可
        Gate::define('cru-higher', function ($user) {
            return ($user->role > 0 && $user->role <= 7);
        });
        // タスクの編集・閲覧を許可
        Gate::define('ru-higher', function ($user) {
            return ($user->role > 0 && $user->role <= 8);
        });
        // 閲覧のみの一般ユーザー以上（つまり全権限）に許可
        Gate::define('r-higher', function ($user) {
            return ($user->role > 0 && $user->role <= 10);
        });
    }
}
