<?php

namespace Myhayo\Branch\Providers;

use Illuminate\Support\ServiceProvider;
use Myhayo\Branch\BranchService;

class BranchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 绑定服务
        $this->app->singleton('branch', function ($app) {
            return new BranchService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/myhayo_branch.php' => config_path('myhayo_branch.php'), // 发布配置文件到 laravel 的config 下
        ]);
    }
}
