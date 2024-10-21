<?php

namespace App\Filament\Resources\HotWheels\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use App\Filament\Clusters\HotWheels\Master;
use App\Models\HotWheels\Master\HotWheelsCarBrand;
use App\Filament\Resources\HotWheels\Master\HotWheelsCarBrandResource\Pages;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\ActionsPosition;

class HotWheelsCarBrandResource extends Resource
{
    protected static ?string $model = HotWheelsCarBrand::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'car-brand';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Car Brand';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'HOTWM001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->unique()
                    ->maxLength(50)
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->maxFiles(1)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        $pageTitle = 'Car Brand';
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Brand')
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
            'index' => Pages\ManageHotWheelsCarBrands::route('/'),
        ];
    }
}
