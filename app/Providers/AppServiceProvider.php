<?php

namespace App\Providers;

use App\Category;
use App\Post;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('pages._sidebar', function($view){
            $view->with('popularPosts', Post::getPopularPost());
            $view->with('featuredPosts', Post::getFeaturedPost());
            $view->with('recentPosts', Post::getRecentPost());
            $view->with('categories', Category::all());
        });
    }
}
