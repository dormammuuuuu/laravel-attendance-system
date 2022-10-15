<?php

namespace App\Providers;

use Debugbar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('search', function ($field, $string){
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });
        Debugbar::disable(); 

        Paginator::defaultView('pagination::default');
 
        Paginator::defaultSimpleView('pagination::simple-default');
    }
}
