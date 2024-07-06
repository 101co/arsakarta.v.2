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
use Filament\Forms\Components\TextInput;
use App\Models\SystemManager\Master\Menu;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Models\SystemManager\Setting\RoleMenu;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers\RoleMenuDetailsRelationManager;
use Filament\Tables\Columns\TextColumn;

class RoleMenuResource extends Resource
{
    protected static ?string $model = RoleMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'System Manager';
    protected static ?string $navigationLabel = 'Role Menu';
    protected static ?int $navigationSort = 6;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKX001';
        return auth()->user()->id==1;
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
            RoleMenuDetailsRelationManager::class
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
