<?php

namespace App\Providers;

use App\Repositories\Contracts\Form\FormRepositoryInterface;
use App\Repositories\Form\FormRepository;
use App\UseCases\Contracts\Form\GetDocumentTypesUseCaseInterface;
use App\UseCases\Form\GetDocumentTypesUseCase;
use Illuminate\Support\ServiceProvider;

class UseCasesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $classes = [
        GetDocumentTypesUseCaseInterface::class => GetDocumentTypesUseCase::class,
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
        //
    }
}
