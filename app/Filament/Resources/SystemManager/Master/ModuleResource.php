<?php

namespace App\Filament\Resources\SystemManager\Master;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use App\Models\SystemManager\Master\Module;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Clusters\SystemManager\Master;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemManager\Master\ModuleResource\Pages;
use App\Filament\Resources\SystemManager\Master\ModuleResource\RelationManagers;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $cluster = Master::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;
   
    // protected static ?string $navigationParentItem = 'Master';
    // protected static ?string $navigationGroup = 'System Manager';
    // protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    // protected static ?string $navigationLabel = 'Module';
    // protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKM001';
        return auth()->user()->id==1;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                    ->required()
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}
