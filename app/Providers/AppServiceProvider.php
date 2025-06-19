<?php

namespace App\Providers;

// Repositories
use App\Infrastructure\Repositories\{ProfileRepository, UserRepository};
use App\Domain\Repositories\{ProfileRepositoryInterface, UserRepositoryInterface};

// UseCases
use App\Application\UseCases\Profile\{DeleteProfileUseCase, ListProfileUseCase, FetchProfileUseCase, StoreProfileUseCase, UpdateProfileUseCase};
use App\Application\UseCases\User\{DeleteUserUseCase, ListUserUseCase, FetchUserUseCase, StoreUserUseCase, UpdateUserUseCase};

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
        // Profile
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        
        $this->app->bind(ListProfileUseCase::class, function ($app) {
            return new ListProfileUseCase($app->make(ProfileRepositoryInterface::class));
        });

        $this->app->bind(FetchProfileUseCase::class, function ($app) {
            return new FetchProfileUseCase($app->make(ProfileRepositoryInterface::class));
        });

        $this->app->bind(StoreProfileUseCase::class, function ($app) {
            return new StoreProfileUseCase($app->make(ProfileRepositoryInterface::class));
        });

        $this->app->bind(UpdateProfileUseCase::class, function ($app) {
            return new UpdateProfileUseCase($app->make(ProfileRepositoryInterface::class));
        });

        $this->app->bind(DeleteProfileUseCase::class, function ($app) {
            return new DeleteProfileUseCase($app->make(ProfileRepositoryInterface::class));
        });
        
        // User
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(ListUserUseCase::class, function ($app) {
            return new ListUserUseCase($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(FetchUserUseCase::class, function ($app) {
            return new FetchUserUseCase($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(StoreUserUseCase::class, function ($app) {
            return new StoreUserUseCase(
                $app->make(UserRepositoryInterface::class),
                $app->make(ProfileRepositoryInterface::class)
            );
        });

        $this->app->bind(UpdateUserUseCase::class, function ($app) {
            return new UpdateUserUseCase(
                $app->make(UserRepositoryInterface::class),
                $app->make(ProfileRepositoryInterface::class)
            );
        });

        $this->app->bind(DeleteUserUseCase::class, function ($app) {
            return new DeleteUserUseCase($app->make(UserRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
