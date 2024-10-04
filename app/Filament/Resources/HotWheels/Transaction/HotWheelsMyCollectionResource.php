<?php

namespace App\Filament\Resources\HotWheels\Transaction;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Clusters\HotWheels\Transaction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Filament\Tables\Columns\Layout\Split as SplitTable;
use App\Models\HotWheels\Transaction\HotWheelsMyCollection;
use App\Filament\Resources\HotWheels\Transaction\HotWheelsMyCollectionResource\Pages;

class HotWheelsMyCollectionResource extends Resource
{
    protected static ?string $model = HotWheelsMyCollection::class;

    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'my-collecion';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'My Collection';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'HOTWT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->maxLength(5)
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull(),
                TextInput::make('color')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull(),
                Select::make('hot_wheels_car_brand_id')
                    ->label('Brand')
                    ->relationship('hotWheelsCarBrand', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('hot_wheels_type_id')
                    ->label('Type')
                    ->relationship('hotWheelsType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('hot_wheels_lot_id')
                    ->label('Lot')
                    ->relationship('hotWheelsLot', 'lot')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('hot_wheels_seri_id')
                    ->label('Seri')
                    ->relationship('hotWheelsSeri', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                FileUpload::make('images')
                    ->maxFiles(5)
                    ->multiple()
                    ->reorderable()
                    // ->acceptedFileTypes(['image/*'])
                    ->columnSpanFull(),
                TextInput::make('year')
                    ->numeric()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('buy_price')
                    ->numeric(),
                TextInput::make('sell_price')
                    ->numeric(),
                Section::make([
                    Checkbox::make('is_owned')
                        ->label('Owned')
                        ->default(false),
                    DatePicker::make('owned_date')
                        ->hiddenLabel()
                ])
                ->compact()
                ->heading('Owned'),
                Section::make([
                    Grid::make(3) // Membuat grid dengan 2 kolom
                        ->schema([
                            Checkbox::make('is_to_be_hunted')
                            ->label('Hunted')
                            ->default(false),
                            Checkbox::make('is_loosed')
                                ->label('Loosed')
                                ->default(false),
                            Checkbox::make('is_active')
                                ->default(true)
                                ->label('Active')
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table {
        $pageTitle = 'My Collection';
        return $table
            ->columns([
                // tampilan untuk mobile
                SplitTable::make([
                    ImageColumn::make('images')
                        ->circular()
                        ->stacked()
                        ->grow(false)
                        ->disk('public')
                        ->url(fn ($record) => $record->getFirstMediaUrl('images')),
                    Stack::make([
                        TextColumn::make('name')
                            ->label('Cast Name')
                            ->weight(FontWeight::Bold)
                            ->searchable()
                            ->sortable()
                            ->grow(false),
                        SplitTable::make([
                            TextColumn::make('hotWheelsCarBrand.name')
                                ->badge()
                                ->color('info')
                                ->label('Brand')
                                ->searchable()
                                ->sortable()
                                ->grow(false),
                            TextColumn::make('hotWheelsType.name')
                                ->badge()
                                ->color('success')
                                ->label('Type')
                                ->searchable()
                                ->sortable()
                                ->grow(false),
                        ]),
                        SplitTable::make([
                            TextColumn::make('is_to_be_hunted')
                                ->html()
                                ->grow(false)
                                ->label('Hunted')
                                ->color('danger')
                                ->badge(fn ($record) => $record->is_to_be_hunted ? true : false)
                                ->hidden(fn ($record) => !$record->is_to_be_hunted ? true : false)
                                ->icon(fn ($record) => $record->is_to_be_hunted ? 'heroicon-o-check-circle' : '')
                                ->getStateUsing(function ($record) {
                                    return $record->is_to_be_hunted
                                        ? '<span class="flex items-center"> Hunted</span>'
                                        : '';
                                }),
                            TextColumn::make('is_owned')
                                ->html()
                                ->label('Owned')
                                ->color('info')
                                ->badge(fn ($record) => $record->is_owned ? true : false)
                                ->icon(fn ($record) => $record->is_owned ? 'heroicon-o-check-circle' : '')
                                ->getStateUsing(function ($record) {
                                    return $record->is_owned
                                        ? '<span class="flex items-center"> Owned</span>'
                                        : '';
                                })
                            ]),
                        IconColumn::make('actions')
                            ->icon('heroicon-o-check-circle')
                            ->label('test')
                    ])
                    ->space(2)
                ])
                ->hiddenFrom('lg'),

                // tampilan untuk web browser
                SplitTable::make([
                    ImageColumn::make('images')
                        ->circular()
                        ->stacked()
                        ->grow(false)
                        ->visibleFrom('lg'),
                    TextColumn::make('name')
                        ->label('Cast Name')
                        ->searchable()
                        ->sortable()
                        ->grow(false)
                        ->visibleFrom('lg'),
                    TextColumn::make('hotWheelsCarBrand.name')
                        ->badge()
                        ->color('info')
                        ->label('Brand')
                        ->searchable()
                        ->sortable()
                        ->grow(false)
                        ->visibleFrom('lg'),
                    TextColumn::make('hotWheelsType.name')
                        ->badge()
                        ->color('success')
                        ->label('Type')
                        ->searchable()
                        ->sortable()
                        ->grow(false)
                        ->visibleFrom('lg'),
                    TextColumn::make('hotWheelsLot.lot')
                        ->badge()
                        ->color('warning')
                        ->label('Lot')
                        ->searchable()
                        ->sortable()
                        ->grow(false)
                        ->visibleFrom('lg'),
                    TextColumn::make('hotWheelsSeri.name')
                        ->badge()
                        ->color('info')
                        ->label('Seri')
                        ->searchable()
                        ->sortable()
                        ->grow(false)
                        ->visibleFrom('lg'),
                    IconColumn::make('is_to_be_hunted')
                        ->label('Hunted')
                        ->boolean(true)
                        ->visibleFrom('lg'),
                    IconColumn::make('is_owned')
                        ->label('Owned')
                        ->boolean(true)
                        ->visibleFrom('lg'),
                    IconColumn::make('is_active')
                        ->label('Active')
                        ->boolean(true)
                        ->visibleFrom('lg')
                ])
                ->from('lg')
            ])
            ->filters([
                Filter::make('is_to_be_hunted')
                    ->label('Hunted')
                    ->query(fn (Builder $query) => $query->where('is_to_be_hunted', true)),
                Filter::make('is_owned')
                    ->label('Owned')
                    ->query(fn (Builder $query) => $query->where('is_owned', true))
            ])
            ->persistFiltersInSession()
            ->contentGrid([
                'sm' => 1,
                'xl' => 2,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update '.$pageTitle, Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete '.$pageTitle, null, null, null)
            ], position: ActionsPosition::AfterColumns)
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
            ->persistColumnSearchesInSession()
            ->heading($pageTitle)
            ->deferLoading()
            ->striped();
    }

    protected function showActionGroup($record)
    {
        return ActionGroup::make([
            Action::make('edit')
                ->label('Edit')
                ->icon('heroicon-s-pencil')
                ->url(fn () => route('edit', $record->id)), // Ganti dengan URL edit yang sesuai

            Action::make('delete')
                ->label('Delete')
                ->icon('heroicon-s-trash')
                ->action(fn () => $record->delete()), // Aksi hapus
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHotWheelsMyCollections::route('/'),
        ];
    }
}
