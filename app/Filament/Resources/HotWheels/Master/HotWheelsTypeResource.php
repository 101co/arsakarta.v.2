<?php

namespace App\Filament\Resources\HotWheels\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Clusters\HotWheels\Master;
use App\Models\HotWheels\Master\HotWheelsType;
use App\Filament\Resources\HotWheels\Master\HotWheelsTypeResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class HotWheelsTypeResource extends Resource
{
    protected static ?string $model = HotWheelsType::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'type';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Type';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $menuCode = 'HOTWM002';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Hot Wheels Type')
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
        $pageTitle = 'Type';
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Hot Wheels Type')
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
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update '.$pageTitle, Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete '.$pageTitle, null, null, null)
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', $pageTitle, Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->defaultPaginationPageOption(10)
            ->heading($pageTitle)
            ->deferLoading()
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHotWheelsTypes::route('/'),
        ];
    }
}
