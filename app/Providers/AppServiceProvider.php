<?php

namespace App\Providers;

use App\Filament\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;

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
        Model::unguard();

        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'account' => UserMenuItem::make()
                    ->label('Your Profile')
                    ->url(UserResource::getUrl(
                            'edit', 
                            ['record' => auth()->user() ?? 1]
                        )
                    ),
                UserMenuItem::make()
                    ->label('Manage Users')
                    ->url(UserResource::getUrl())
                    ->icon('heroicon-s-users'),
                // ...
            ]);
        });
    }
}
