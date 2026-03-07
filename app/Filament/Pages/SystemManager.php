<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;

class SystemManager extends Page
{
    protected static ?string $navigationLabel = 'System Manager';
    
    protected static ?string $title = 'System Manager';
    
    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }
    
    public static function getNavigationSort(): ?int
    {
        return 2;
    }
    
    protected string $view = 'filament.pages.system-manager';

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('update_app')
                    ->label('Update App')
                    ->color('success')
                    ->icon('heroicon-o-arrow-path')
                    ->requiresConfirmation()
                    ->action(function () {
    
                        exec('git pull origin main');
    
                        Artisan::call('migrate', [
                            '--force' => true
                        ]);
    
                        Artisan::call('optimize:clear');
                        Artisan::call('optimize');
                    })
                    ->successNotificationTitle('App Updated'),
    
                Action::make('config_cache')
                    ->label('Config Cache')
                    ->icon('heroicon-o-bolt')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('config:cache'))
                    ->successNotificationTitle('Config Cached'),
    
                Action::make('route_cache')
                    ->label('Route Cache')
                    ->icon('heroicon-o-map')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('route:cache'))
                    ->successNotificationTitle('Route Cached'),
    
                Action::make('view_cache')
                    ->label('View Cache')
                    ->icon('heroicon-o-eye')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('view:cache'))
                    ->successNotificationTitle(title: 'View Cached'),
    
                Action::make('clear_cache')
                    ->label('Clear Cache')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->action(function () {
    
                        Artisan::call('cache:clear');
                        Artisan::call('config:clear');
                        Artisan::call('route:clear');
                        Artisan::call('view:clear');
    
                    })
                    ->successNotificationTitle('Clear Cached Succees'),
    
                Action::make('optimize')
                    ->label('Optimize')
                    ->icon('heroicon-o-rocket-launch')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('optimize'))
                    ->successNotificationTitle('Optimize Succees'),
    
                Action::make('optimize_clear')
                    ->label('Optimize Clear')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('optimize:clear'))
                    ->successNotificationTitle('Optimize Clear Succees'),
    
                Action::make('storage_link')
                    ->label('Storage Link')
                    ->icon('heroicon-o-link')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('storage:link'))
                    ->successNotificationTitle('Storage Link Succees'),
            ])->label('System Tools')
            ->icon('heroicon-o-wrench-screwdriver')
            ->extraAttributes([
                'class' => 'flex flex-wrap gap-2'
            ])
            ->button(),

        ];
    }

    public function getViewData(): array
    {
        return [
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'app_env' => app()->environment(),
            'app_debug' => config('app.debug'),
            'app_url' => config('app.url'),
            'app_version' => config('app.version', 'v1.0.0'),
        ];
    }

}