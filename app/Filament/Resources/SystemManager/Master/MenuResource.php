<?php

namespace App\Filament\Resources\SystemManager\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Models\SystemManager\Master\Menu;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Clusters\SystemManager\Master;
use App\Filament\Resources\SystemManager\Master\MenuResource\Pages;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'menu';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKM003';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('code')
                            ->required()
                            ->label('Menu Code')
                            ->maxLength(10),
                        TextInput::make('description')
                            ->maxLength(255),
                        Select::make('application_id')
                            ->relationship('application', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->label('Menu Code')
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('application.name')
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                SelectFilter::make('application_id')
                    ->label('Application')
                    ->relationship('application', 'name')
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', null, Icons::EDIT, null, false, true),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Menu', null, null, null, true)
            ], position: ActionsPosition::BeforeColumns)
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false, true)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null, true)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false, true)
            ])
            ->defaultPaginationPageOption(10)
            ->heading('Menu')
            ->striped()
            ->deferLoading()
            ->persistFiltersInSession();
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
