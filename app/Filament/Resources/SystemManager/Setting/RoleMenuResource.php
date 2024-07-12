<?php

namespace App\Filament\Resources\SystemManager\Setting;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Models\SystemManager\Master\Menu;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Models\SystemManager\Setting\RoleMenu;
use App\Filament\Clusters\SystemManager\Setting;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers\RoleMenuUsersRelationManager;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers\RoleMenuDetailsRelationManager;

class RoleMenuResource extends Resource
{
    protected static ?string $model = RoleMenu::class;

    protected static ?string $cluster = Setting::class;
    protected static ?string $slug = 'role-menu-user';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKX001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('role_id')
                            ->searchable()
                            ->relationship('role', 'role')
                            ->required()
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('role.role')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RoleMenuDetailsRelationManager::class,
            RoleMenuUsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoleMenus::route('/'),
            'create' => Pages\CreateRoleMenu::route('/create'),
            'edit' => Pages\EditRoleMenu::route('/{record}/edit'),
        ];
    }
}
