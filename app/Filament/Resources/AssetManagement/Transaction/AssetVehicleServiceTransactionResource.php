<?php

namespace App\Filament\Resources\AssetManagement\Transaction;

use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Clusters\AssetManagement\Transaction;
use App\Models\AssetManagement\Transaction\AssetVehicleServiceTransaction;
use App\Filament\Resources\AssetManagement\Transaction\AssetVehicleServiceTransactionResource\Pages;
use App\Models\AssetManagement\Master\Asset;
use App\Models\AssetManagement\Master\AssetDetail;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class AssetVehicleServiceTransactionResource extends Resource
{
    protected static ?string $model = AssetVehicleServiceTransaction::class;

    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'vehicle-service';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Vehicle Service';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $menuCode = 'ASTMT002';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('asset_id')
                    ->label('Vehicle')
                    ->required()
                    ->relationship('asset', 'asset_name')
                    ->columnSpanFull()
                    ->searchable()
                    ->preload(),
                DatePicker::make('service_date')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('current_odometer')
                    ->label('Current Odometer')
                    ->suffix('Km')
                    ->afterStateUpdated(function(Get $get, Set $set)
                    {
                        $asset = Asset::where('id', '=', $get('asset_id'))->get();
                        $assetDetail = AssetDetail::where('asset_detail', '=', 'Kilometer Servis')
                                        ->where('asset_type_id', '=', $asset[0]['asset_type_id'])
                                        ->first();
                        $assetDetailId = $assetDetail['id'];
                        $asset_detail = $asset->pluck('asset_detail');

                        $result = array_filter($asset_detail[0], function($item) use ($assetDetailId)
                        {
                            return $item['asset_detail_id'] == $assetDetailId;
                        });

                        $value = null;
                        foreach ($result as $item) 
                        {
                            $value = $item['value'];
                            break;
                        }

                        $set('next_odometer', $get('current_odometer') + $value);
                    })
                    ->live()
                    ->required()
                    ->numeric(),
                TextInput::make('next_odometer')
                    ->label('Next Odometer')
                    ->suffix('Km')
                    ->required(),
                TextInput::make('service_location')
                    ->label('Bengkel')
                    ->maxLength(100)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label('Service Amount')
                    ->prefix('IDR')
                    ->required()
                    ->numeric()
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->label('Attachment')
                    ->nullable()
                    ->maxFiles(5)
                    ->columnSpanFull(),
                Checkbox::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->columnSpanFull(),
                Section::make()
                    ->heading('Service Details')
                    ->schema([
                        Repeater::make('service_details')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('title')
                                    ->maxLength(100)
                                    ->inlineLabel(),
                                TextInput::make('detail_1')
                                    ->maxLength(50)
                                    ->inlineLabel()
                            ])
                            ->addActionLabel('Add detail')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        $pageTitle = 'Vehicle Service';
        return $table
            ->columns([
                TextColumn::make('asset.asset_name')
                    ->label('Vehicle')
                    ->searchable()
                    ->sortable()
                    ->grow(false),
                TextColumn::make('service_date')
                    ->date('d/m/Y'),
                TextColumn::make('current_odometer')
                    ->label('Current Odometer')
                    ->suffix(' Km'),
                TextColumn::make('next_odometer')
                    ->label('Current Odometer')
                    ->suffix(' Km'),
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
            'index' => Pages\ManageAssetVehicleServiceTransactions::route('/'),
        ];
    }
}
