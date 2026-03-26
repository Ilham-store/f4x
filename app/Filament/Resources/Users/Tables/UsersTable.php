<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('roles.name')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'developer' => 'danger',
                        'admin' => 'info',
                        default => 'warning',
                    })
                    ->separator(', ')
                    ->label('Role'),

                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

            ])->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('Roles')
                    ->relationship('roles', 'name')
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                ->visible(fn ($record) =>
                    Filament::auth()->check() &&
                    $record->getKey() !== Filament::auth()->id()
                ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('manageRoles')
                    ->label('Manage Roles')
                    ->icon('heroicon-o-shield-check')
                    ->color('info')
                    ->modalSubmitActionLabel('Simpan') 
                    ->modalCancelActionLabel('Batal')
                    ->slideOver()
                    ->fillForm(fn () => [
                        'roles' => Role::all()->map(fn($role) => [
                            'id' => $role->id,
                            'name' => $role->name,
                        ])->toArray(),
                    ])
                    ->form([
                        Repeater::make('roles')
                            ->label('Daftar Role')
                            ->schema([
                                Hidden::make('id'),
                                TextInput::make('name')
                                    ->required()
                                    ->distinct()
                                    ->disableLabel()
                                    ->placeholder('Nama Role'),
                            ])
                            ->addActionLabel('Tambah Role Baru')
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->collapsible()
                            ->defaultItems(0)
                            ->deleteAction(
                                fn (Action $action) => $action
                                    ->requiresConfirmation()
                                    ->before(function (array $arguments, $component, Action $action, Component $livewire) {
                                        $itemData = $component->getState()[$arguments['item']] ?? null;
                            
                                        if ($itemData && !empty($itemData['id'])) {
                                            $role = Role::find($itemData['id']);
                            
                                            if ($role) {
                                                if ($role->users()->count() > 0) {
                                                    Notification::make()
                                                        ->warning()
                                                        ->title("Gagal menghapus!")
                                                        ->body("Role '{$role->name}' masih digunakan oleh pengguna.")
                                                        ->send();
                                                    $action->halt();
                                                }
                            
                                                $role->delete();
                                                app(PermissionRegistrar::class)->forgetCachedPermissions();
                            
                                                $livewire->dispatch('$refresh');
                            
                                                Notification::make()
                                                    ->success()
                                                    ->title("Role '{$role->name}' berhasil dihapus!")
                                                    ->send();
                                            }
                                        }
                                    })
                            )
                    ])
                    ->action(function (array $data, Component $livewire) {
                        $submittedRoles = collect($data['roles'] ?? []);
                    
                        foreach ($submittedRoles as $roleData) {
                            if (!empty($roleData['id'])) {
                                Role::where('id', $roleData['id'])->update(['name' => $roleData['name']]);
                            } else {
                                Role::create(['name' => $roleData['name'], 'guard_name' => 'web']);
                            }
                        }
                    
                        app(PermissionRegistrar::class)->forgetCachedPermissions();
                    
                        $livewire->dispatch('$refresh');
                    
                        Notification::make()
                            ->success()
                            ->title('Perubahan Daftar Role berhasil disimpan!')
                            ->send();
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->visible(fn ($record) =>
                        Filament::auth()->check() &&
                        $record->getKey() !== Filament::auth()->id()
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
