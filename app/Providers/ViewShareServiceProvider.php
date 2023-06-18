<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewShareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.layouts.app','admin.auth.login','frontend.pages.home' ,'frontend.layouts.master', 'frontend.pages.sellers', 'mail.*'], 'App\Http\ViewComposers\SiteComposer');
    }
}
