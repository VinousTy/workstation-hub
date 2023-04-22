<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private const USECASES = [
        'Profile' => [
            'GetAuthUserProfile',
        ],
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (self::USECASES as $usecase => $functions) {
          foreach ($functions as $function) {
              $this->app->singleton(
                "App\UseCases\\{$usecase}\\{$function}\\{$function}UseCaseInterface",
                "App\UseCases\\{$usecase}\\{$function}\\{$function}UseCase"
              );
          }
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
