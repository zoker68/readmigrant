<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*view()->composer('admin.layouts.main', function ($view) {
            $view->with('countUnModerateAuthor',
                Author::where('is_moderate',0)->count());
        });*/
        Inertia::share('genreAll', Genre::all());
    }
}
