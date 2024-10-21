<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ToggleColumn;
use App\Models\DigitalInvitation\Master\Package;
use App\Filament\Clusters\DigitalInvitation\Master;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\PackageResource\Pages;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

class PackageResource extends Resource {
    protected static ?string $model = Package::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'package';
    protected static ?string $navigationLabel = 'Package';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 4;

    public static function canViewAny(): bool {
        $menuCode = 'INVTM004';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('initial')
                    ->required()
                    ->maxLength(5)
                    ->columnSpanFull()
                    ->label('Initial')
                    ->placeholder('P001')
                    ->unique(ignoreRecord: true)
                    ->default(fn () => Package::generateCode()),
                TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull()
                    ->label('Package')
                    ->placeholder('Free Trial'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->label('Price')
                    ->columnSpanFull()
                    ->prefix('IDR')
                    ->placeholder('45000'),
                TextInput::make('editing_days')
                    ->required()
                    ->numeric()
                    ->label('Editing Days')
                    ->columnSpanFull()
                    ->placeholder('7'),
                Checkbox::make('is_trial')
                    ->default(false)
                    ->columnSpanFull()
                    ->label('For Trial'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->columnSpanFull()
                    ->label('Active'),
                Section::make([
                    Repeater::make('detail')
                        ->hiddenLabel()
                        ->schema([
                            TextInput::make('description')
                        ])
                ])
                ->heading('Detail')
                ->collapsible()
                ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table {
        $title = 'Package';
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        Split::make([
                            TextColumn::make('initial')
                                ->sortable()
                                ->searchable()
                                ->grow(false)
                                ->label('Initial'),
                            TextColumn::make('themeCategory.name')
                                ->badge()
                                ->color('success')
                        ]),
                        TextColumn::make('name')
                            ->sortable()
                            ->searchable()
                            ->label('Theme Master')
                            ->weight(FontWeight::SemiBold)
                            ->size(TextColumnSize::Medium)
                    ])
                    ->space(2),
                    ToggleColumn::make('is_active')
                        ->alignEnd()
                        ->label('Active')
                ])
            ])
            ->filters([])
            ->contentGrid([
                'sm' => 1,
                'xl' => 3,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update '.$title, Icons::EDIT, null, false, true),
                getCustomTableAction(ActionType::DELETE, null, 'Delete '.$title, null, null, null, true)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null, true)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Add '.$title, Icons::ADD, false, false, true)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false, true)
            ])
            ->striped()
            ->deferLoading()
            ->heading($title)
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession()
            ->defaultPaginationPageOption(10);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ManagePackages::route('/'),
        ];
    }
}
