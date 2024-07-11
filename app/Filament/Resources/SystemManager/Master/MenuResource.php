<?php

namespace App\Filament\Resources\SystemManager\Master;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Models\SystemManager\Master\Menu;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\SystemManager\Master;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemManager\Master\MenuResource\Pages;
use App\Filament\Resources\SystemManager\Master\MenuResource\RelationManagers;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $cluster = Master::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?int $navigationSort = 3;

    // protected static ?string $navigationParentItem = 'System Manager';
    // protected static ?string $navigationGroup = 'Master';

    // protected static ?string $navigationIcon = 'heroicon-o-wallet';
    // protected static ?string $navigationGroup = 'System Manager';
    // protected static ?string $navigationParentItem = 'Master';
    // protected static ?string $navigationLabel = 'Menu';
    // protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKM003';
        return auth()->user()->id==1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required()
                    ->maxLength(10),
                TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Select::make('application_id')
                    ->relationship('application', 'name')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('application.name')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
            ])
            ->filters([
                SelectFilter::make('application_id')
                    ->label('Application')
                    ->relationship('application', 'name')
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
