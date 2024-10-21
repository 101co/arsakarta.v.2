<?php

namespace App\Filament\Resources\HotWheels\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Clusters\HotWheels\Master;
use App\Models\HotWheels\Master\HotWheelsLot;
use App\Filament\Resources\HotWheels\Master\HotWheelsLotResource\Pages;

class HotWheelsLotResource extends Resource
{
    protected static ?string $model = HotWheelsLot::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'lot';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Lot';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        $menuCode = 'HOTWM003';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('lot')
                    ->label('Lot')
                    ->required()
                    ->unique()
                    ->maxLength(100)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->columnSpanFull()
                    ->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        $pageTitle = 'Lot';
        return $table
            ->columns([
                TextColumn::make('lot')
                    ->label('Lot')
                    ->searchable()
                    ->sortable()
                    ->grow(false),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(true)
            ])
            ->filters([])
            ->contentGrid([
                // 'sm' => 1,
                // 'xl' => 1,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update '.$pageTitle, Icons::EDIT, null, false, true),
                getCustomTableAction(ActionType::DELETE, null, 'Delete '.$pageTitle, null, null, null, true)
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null, true)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', $pageTitle, Icons::ADD, false, false, true)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false, true)
            ])
            ->defaultPaginationPageOption(10)
            ->heading($pageTitle)
            ->deferLoading()
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHotWheelsLots::route('/'),
        ];
    }
}
