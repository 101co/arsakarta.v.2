<?php

namespace App\Filament\Resources\SystemManager\Setting;

use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource\RelationManagers;
use App\Models\SystemManager\Master\Menu;
use App\Models\SystemManager\Setting\RoleMenu;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleMenuResource extends Resource
{
    protected static ?string $model = RoleMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'System Manager';

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKX001';
        return auth()->user()->id==1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('role_id')
                    ->searchable()
                    ->relationship('role', 'role')
                    ->required()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            //
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
