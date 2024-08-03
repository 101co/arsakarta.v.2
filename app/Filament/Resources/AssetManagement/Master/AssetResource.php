<?php

namespace App\Filament\Resources\AssetManagement\Master;

use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ToggleColumn;
use App\Models\AssetManagement\Master\Asset;
use App\Models\AssetManagement\Master\AssetType;
use App\Filament\Clusters\AssetManagement\Master;
use App\Models\AssetManagement\Master\AssetDetail;
use App\Filament\Resources\AssetManagement\Master\AssetResource\Pages;
use Throwable;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'asset';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Start;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Aset';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        $menuCode = 'ASTMM003';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('asset_type_id')
                            ->required()
                            ->placeholder('Pilih Tipe Aset')
                            ->label('Tipe Aset')
                            ->options(AssetType::where('is_active', '=', true)->pluck('asset_type', 'id'))
                            ->live(),
                        TextInput::make('asset_name')
                            ->label('Aset')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(100)
                            ->columnSpanFull()
                    ]),
                Section::make()
                    ->heading('Info Aset')
                    ->schema([
                        Repeater::make('asset_detail')
                            ->schema([
                                Select::make('asset_detail_id')
                                    ->required()
                                    ->placeholder('Pilih Info Aset')
                                    ->label('Info Aset')
                                    ->options(function (Get $get) {
                                        try 
                                        {
                                            if (! empty($get('../../asset_type_id')))
                                            {
                                                return AssetDetail::where('asset_type_id', $get('../../asset_type_id'))
                                                    ->get()
                                                    ->pluck('asset_detail', 'id');
                                            }
                                            return null;
                                        }
                                        catch (\Throwable $th) 
                                        {
                                           dd($th);
                                        }
                                    })
                                    ->searchable()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->getSearchResultsUsing(fn (string $search, Get $get): array => 
                                        AssetDetail::where('asset_detail', 'like', "%{$search}%")
                                            ->where('asset_type_id', '=', $get('../../asset_type_id'))
                                            ->limit(50)
                                            ->pluck('asset_detail', 'id')
                                            ->toArray()
                                    )
                                    ->live(),
                                TextInput::make('value')
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['asset_detail_id'] ? AssetDetail::where('id', '=', $state['asset_detail_id'])->pluck('asset_detail')->first()  : null)
                            ->addActionLabel('Tambahkan Info')
                            ->hiddenLabel()
                            ->columns(2)
                            ->reorderable(false)
                            ->collapsible()
                    ])
                    ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('asset_name')
                        ->label('Aset')
                        ->searchable()
                        ->sortable(),
                    ToggleColumn::make('is_active')
                        ->label('Is Active')
                        ->alignEnd()
                ])
            ])
            ->filters([])
            ->contentGrid([
                'sm' => 1,
                'xl' => 1,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update Aset', Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Aset', null, null, null)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Aset', Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->defaultPaginationPageOption(10)
            ->heading('Aset')
            ->deferLoading()
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAssets::route('/'),
        ];
    }
}
