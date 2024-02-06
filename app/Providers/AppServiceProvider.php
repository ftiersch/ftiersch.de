<?php

namespace App\Providers;

use App\Repositories\ContentPieceRepository;
use App\Services\ContentPieceService;
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
        $this->app->singleton(ContentPieceService::class, function () {
            return new ContentPieceService(app(ContentPieceRepository::class));
        });
    }
}
