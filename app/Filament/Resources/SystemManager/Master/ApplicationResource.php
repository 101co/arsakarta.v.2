<?php

namespace App\Filament\Resources\SystemManager\Master;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\SystemManager\Master;
use App\Models\SystemManager\Master\Application;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemManager\Master\ApplicationResource\Pages;
use App\Filament\Resources\SystemManager\Master\ApplicationResource\RelationManagers;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $cluster = Master::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?int $navigationSort = 2;
    
    // protected static ?string $navigationParentItem = 'System Manager';
    // protected static ?string $navigationGroup = 'Master';

    // protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    // protected static ?string $navigationGroup = 'System Manager';
    // protected static ?string $navigationParentItem = 'Master';
    // protected static ?string $navigationLabel = 'Application';
    // protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKM002';
        return auth()->user()->id==1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                Select::make('module_id')
                    ->relationship('module', 'description')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description')
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
