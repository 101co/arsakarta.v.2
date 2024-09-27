<?php

namespace App\Filament\Resources\AssetManagement\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Clusters\AssetManagement\Master;
use App\Models\AssetManagement\Master\AssetDetail;
use App\Filament\Resources\AssetManagement\Master\AssetDetailResource\Pages;
use App\Models\AssetManagement\Master\AssetType;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Illuminate\Validation\Rules\Unique;

class AssetDetailResource extends Resource
{
    protected static ?string $model = AssetDetail::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'asset-detail';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Aset Detail';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $menuCode = 'ASTMM002';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('asset_type_id')
                    ->required()
                    ->placeholder('Pilih Tipe Aset')
                    ->label('Tipe Aset')
                    ->options(AssetType::where('is_active', '=', true)->pluck('asset_type', 'id'))
                    ->live()
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search): array => AssetType::where('asset_type', 'like', "%{$search}%")->limit(50)->pluck('asset_type', 'id')->toArray()),
                TextInput::make('asset_detail')
                    ->label('Detail')
                    ->required()
                    ->unique(ignoreRecord: true,
                            modifyRuleUsing: function (Get $get, Unique $rule)
                            {
                                return $rule->where('asset_type_id',$get('asset_type_id'));
                            })
                    ->maxLength(100)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('asset_detail')
                        ->label('Aset Detail')
                        ->searchable()
                        ->sortable(),
                    ToggleColumn::make('is_active')
                        ->label('Is Active')
                        ->alignEnd()
                ]),
                TextColumn::make('assetType.asset_type')
                    ->badge('success')
                    ->label('Tipe Aset')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([])
            ->contentGrid([
                'sm' => 1,
                'xl' => 1,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update Tipe Aset', Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Tipe Aset', null, null, null)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Tipe Aset', Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->defaultPaginationPageOption(10)
            ->heading('Tipe Aset')
            ->deferLoading()
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAssetDetails::route('/'),
        ];
    }
}
