<?php

namespace App\Filament\Resources\SystemManager\Setting;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Enums\ActionsPosition;
use App\Models\SystemManager\Setting\RoleMenu;
use App\Filament\Clusters\SystemManager\Setting;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;
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
                Split::make([
                    Section::make()
                        ->schema([
                            Select::make('role_id')
                                ->searchable()
                                ->relationship('role', 'role')
                                ->required()
                                ->preload()
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('role.role')
                    ->searchable()
                    ->sortable()
            ])
            ->filters([])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Choose Menu', Icons::EDIT, null, false, true),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Menu', null, null, null, true)
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null, true)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose Menu', Icons::ADD, false, false, true)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose Menu', Icons::ADD, false, false, true)
            ])
            ->defaultPaginationPageOption(10)
            ->striped()
            ->heading('Setting Role Menu User')
            ->deferLoading();
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
