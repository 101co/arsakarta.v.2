<?php

namespace App\Filament\Resources\AssetManagement\Transaction;

use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ToggleColumn;
use App\Models\AssetManagement\Master\Asset;
use Filament\Forms\Components\Split as FormSplit;
use App\Filament\Clusters\AssetManagement\Transaction;
use App\Models\AssetManagement\Transaction\PajakKendaraan;
use App\Filament\Resources\AssetManagement\Transaction\PajakKendaraanResource\Pages;
use Filament\Forms\Get;
use Filament\Forms\Set;

class PajakKendaraanResource extends Resource
{
    protected static ?string $model = PajakKendaraan::class;

    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'pajak-kendaraan';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Start;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Pajak Kendaraan';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'ASTMT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('asset_id')
                    ->label('Kendaraan')
                    ->required()
                    ->searchable()
                    ->options(
                        Asset::where('is_active', '=', true)
                            ->pluck('asset_name', 'id')
                    )
                    ->columnSpanFull(),
                DatePicker::make('tanggal_pajak')
                    ->label('Tanggal Pajak')
                    ->afterStateUpdated(fn(Get $get, Set $set) => $set('tanggal_pajak_selanjutnya', $get('tanggal_pajak')))
                    ->live()
                    ->columnSpanFull(),
                DatePicker::make('tanggal_pajak_selanjutnya')
                    ->label('Tanggal Pajak Selanjutnya')
                    ->columnSpanFull(),
                Checkbox::make('is_pajak_tahunan')
                    ->default(true)
                    ->label('Pajak Tahunan')
                    ->columnSpanFull(),
                TextInput::make('amount')
                    ->numeric()
                    ->prefix('IDR')
                    ->label('Total Dibayarkan'),
                Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('asset.asset_name')
                        ->label('Asset')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('is_pajak_tahunan')
                        ->badge()
                        ->formatStateUsing(fn (bool $state) => match($state)
                        {
                            true => 'Pajak Tahunan',
                            false => 'Pajak Lima Tahun'
                        })
                        ->color(fn(bool $state) => match($state) 
                        {
                            true => 'success',
                            false => 'danger'
                        }),
                    TextColumn::make('amount')
                        ->label('Total Dibayarkan')
                        ->money('IDR'),
                    ToggleColumn::make('is_active')
                        ->label('Is Active')
                        ->alignEnd()
                ]),
                TextColumn::make('tanggal_pajak')
                    ->label('Tanggal Pajak')
                    ->date('d M Y')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tanggal_pajak_selanjutnya')
                    ->label('Tanggal Pajak Selanjutnya')
                    ->date('d M Y')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([])
            ->contentGrid([
                'sm' => 1,
                'xl' => 1,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update Pajak Kendaraan', Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Pajak Kendaraan', null, null, null)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Pajak Kendaraan', Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->defaultPaginationPageOption(10)
            ->heading('Pajak Kendaraan')
            ->deferLoading()
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePajakKendaraans::route('/'),
        ];
    }
}
