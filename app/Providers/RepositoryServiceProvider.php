<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private const MODELS = [
        'User' => [
            'Auth',
        ],
        'Profile' => [
            'Profile',
        ],
        'Image' => [
            'S3',
            'Image',
        ],
        'Desk' => [
            'Desk',
        ],
        'Category' => [
            'Category',
        ],
        'DeskCategory' => [
            'DeskCategory',
        ],
        'Notification' => [
            'Notification',
        ],
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      foreach (self::MODELS as $model => $functions) {
        foreach ($functions as $function) {
            $this->app->singleton(
              "App\Repositories\\{$model}\\{$function}\\{$function}UserRepository",
              "App\Repositories\\{$model}\\{$function}\\{$function}UserRepositoryImpl",
            );
            $this->app->singleton(
              "App\Repositories\\{$model}\\{$function}Repository",
              "App\Repositories\\{$model}\\{$function}RepositoryImpl"
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
