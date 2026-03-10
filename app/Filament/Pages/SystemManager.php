<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
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

                        try {
                    
                            exec('git pull origin main 2>&1', $output);
                    
                            Artisan::call('migrate', [
                                '--force' => true
                            ]);
                    
                            Artisan::call('optimize:clear');
                            Artisan::call('optimize');
                    
                            Notification::make()
                                ->title('App Updated')
                                ->body(implode("\n", $output))
                                ->success()
                                ->send();
                    
                        } catch (\Throwable $e) {
                    
                            Notification::make()
                                ->title('Update Failed')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                    
                        }
                    
                    }),

                Action::make('config_cache')
                    ->label('Config Cache')
                    ->icon('heroicon-o-bolt')
                    ->requiresConfirmation()
                    ->action(function () {

                        Artisan::call('config:cache');

                        Notification::make()
                            ->title('Config Cached')
                            ->body(Artisan::output())
                            ->success()
                            ->send();
                    }),
    
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
                    ->successNotificationTitle('Clear Cached Success'),
    
                Action::make('optimize')
                    ->label('Optimize')
                    ->icon('heroicon-o-rocket-launch')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('optimize'))
                    ->successNotificationTitle('Optimize Success'),
    
                Action::make('optimize_clear')
                    ->label('Optimize Clear')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('optimize:clear'))
                    ->successNotificationTitle('Optimize Clear Success'),
    
                Action::make('storage_link')
                    ->label('Storage Link')
                    ->icon('heroicon-o-link')
                    ->requiresConfirmation()
                    ->action(fn () => Artisan::call('storage:link'))
                    ->successNotificationTitle('Storage Link Success'),
            ])->label('System Tools')
            ->icon('heroicon-o-wrench-screwdriver')
            ->extraAttributes([
                'class' => 'flex flex-wrap gap-2'
            ])
            ->button()
            ->color('warning'),
            
            ActionGroup::make([
                Action::make('maintenance_on')
                ->label('Enable Maintenance')
                ->color('danger')
                ->icon('heroicon-o-pause-circle')
                ->requiresConfirmation()
                ->action(function () {
            
                    $secret = 'admin-bypass-2104';
            
                    Artisan::call('down', [
                        '--secret' => $secret,
                    ]);
                    
                    Notification::make()
                        ->title('Maintenance Enabled')
                        ->body('Bypass URL: ' . url($secret))
                        ->success()
                        ->send();
                        
                    return redirect()->away(url('/'.$secret))->away(url("/admin/login"))->away(url("/admin/system-manager"));
                    
                }),

                Action::make('maintenance_off')
                ->label('Disable Maintenance')
                ->color('success')
                ->icon('heroicon-o-play-circle')
                ->requiresConfirmation()
                ->action(function () {
            
                    Artisan::call('up');
            
                    Notification::make()
                        ->title('Maintenance Disabled')
                        ->success()
                        ->send();
                }),
                    
            ])->label('Maintenance Mode')
            ->icon('heroicon-o-link-slash')
            ->extraAttributes([
                'class' => 'flex flex-wrap gap-2'
            ])->button()
            ->color('danger'),

        ];
    }

    public function getViewData(): array
    {

        // Cek apakah file version.txt ada, jika tidak pakai default config
        $versionPath = base_path('version.txt');
        $currentVersion = file_exists($versionPath) 
            ? trim(file_get_contents($versionPath)) 
            : config('app.version', 'v1.0.0');

        // Cek apakah ada update dari Git
        $hasUpdate = false;
        try {
            // Mengambil info dari git fetch tanpa menarik datanya (hanya cek)
            exec('git fetch origin main');
            // Membandingkan commit lokal dengan remote
            $local = shell_exec('git rev-parse HEAD');
            $remote = shell_exec('git rev-parse origin/main');
            
            $hasUpdate = trim($local) !== trim($remote);
        } catch (\Throwable $e) {
            $hasUpdate = false;
        }

        return [
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'app_env' => app()->environment(),
            'app_debug' => config('app.debug'),
            'app_url' => config('app.url'),
            'app_version' => $currentVersion,
            'has_update' => $hasUpdate,
        ];
    }

    public static function canAccess(): bool
    {
        return Filament::auth()->user()?->hasRole('admin') ?? false;
    }

    public static function getNavigationBadge(): ?string
    {
        // Gunakan cache agar tidak menjalankan git fetch terlalu sering di sidebar
        return cache()->remember('git_update_badge', 3600, function () {
            try {
                exec('git fetch origin main');
                $local = shell_exec('git rev-parse HEAD');
                $remote = shell_exec('git rev-parse origin/main');
                return trim($local) !== trim($remote) ? 'NEW' : null;
            } catch (\Throwable $e) {
                return null;
            }
        });
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

}