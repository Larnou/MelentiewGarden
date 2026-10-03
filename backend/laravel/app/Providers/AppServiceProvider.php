<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\ServiceProvider;

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
        Json::encodeUsing(function (mixed $value, int $flags = 0): string|false {
            return json_encode($value, $flags | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        });
    }
}
