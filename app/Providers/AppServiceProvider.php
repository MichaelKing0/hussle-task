<?php

namespace App\Providers;

use App\UrlShortener\Shorteners\Base62Shortener;
use App\UrlShortener\Shorteners\ShortenerInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShortenerInterface::class, Base62Shortener::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
