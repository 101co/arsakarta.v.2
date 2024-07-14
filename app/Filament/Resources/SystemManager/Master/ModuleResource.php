<?php

namespace App\Filament\Resources\SystemManager\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Enums\ActionsPosition;
use App\Models\SystemManager\Master\Module;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Clusters\SystemManager\Master;
use App\Filament\Resources\SystemManager\Master\ModuleResource\Pages;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'module';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKM001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make()
                        ->schema([
                            TextInput::make('description')
                                ->required()
                                ->maxLength(255)
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Module')
            ->deferLoading()
            ->columns([
                TextColumn::make('description')
                    ->label('Module')
                    ->searchable()
            ])
            ->filters([])
            ->actions([
                EditAction::make()
                    ->tooltip('edit')
                    ->hiddenLabel()
                    ->icon(Icons::EDIT->value),
                DeleteAction::make()
                    ->tooltip('delete')
                    ->hiddenLabel(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                DeleteBulkAction::make()
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add')
                    ->icon(Icons::ADD->value)
            ])
            ->emptyStateActions([
                CreateAction::make()
                    ->label('Add')
                    ->icon(Icons::ADD->value)

            ])
            ->defaultPaginationPageOption(10)
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
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
