<?php

namespace App\Filament\Resources\AssetManagement\Master;

use Filament\Forms;
use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\AssetManagement\Master\AssetType;
use App\Filament\Clusters\AssetManagement\Master;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssetManagement\Master\AssetTypeResource\Pages;
use App\Filament\Resources\AssetManagement\Master\AssetTypeResource\RelationManagers;

class AssetTypeResource extends Resource
{
    protected static ?string $model = AssetType::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'asset-type';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Start;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Tipe Aset';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'ASTMM001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('asset_type')
                    ->label('Tipe Aset')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('asset_type')
                        ->label('Tipe Aset')
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
            'index' => Pages\ManageAssetTypes::route('/'),
        ];
    }
}
