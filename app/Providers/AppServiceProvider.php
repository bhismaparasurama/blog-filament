<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        if (env('UPLOAD_MAX_FILESIZE')) {
            ini_set('upload_max_filesize', env('UPLOAD_MAX_FILESIZE'));
        }

        if (env('POST_MAX_SIZE')) {
            ini_set('post_max_size', env('POST_MAX_SIZE'));
        }

        if (env('MEMORY_LIMIT')) {
            ini_set('memory_limit', env('MEMORY_LIMIT'));
        }
    }
}
