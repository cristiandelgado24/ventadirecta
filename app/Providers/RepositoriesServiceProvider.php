<?php

namespace App\Providers;

use App\Repositories\Contracts\Form\FormRepositoryInterface;
use App\Repositories\Contracts\SINU\SINURepositoryInterface;
use App\Repositories\Form\FormRepository;
use App\Repositories\SINU\SINURepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    protected $classes = [
        FormRepositoryInterface::class => FormRepository::class,
        SINURepositoryInterface::class => SINURepository::class
    ];

    public function register()
    {
        foreach ($this->classes as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
