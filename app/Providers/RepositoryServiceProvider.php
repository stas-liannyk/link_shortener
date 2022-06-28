<?php

namespace App\Providers;

use App\Interfaces\LinkRepositoryInterface;
use App\Repository\LinkRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LinkRepositoryInterface::class, LinkRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
