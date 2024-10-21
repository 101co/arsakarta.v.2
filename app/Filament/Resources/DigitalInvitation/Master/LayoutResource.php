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
use App\Models\DigitalInvitation\Master\Layout;
use App\Filament\Clusters\DigitalInvitation\Master;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\LayoutResource\Pages;

class LayoutResource extends Resource
{
    protected static ?string $model = Layout::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'layout';
    protected static ?string $navigationLabel = 'Layout';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 5;

    public static function canViewAny(): bool {
        $menuCode = 'INVTM005';
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
                    ->placeholder('L001')
                    ->unique(ignoreRecord: true)
                    ->default(fn () => Layout::generateCode()),
                TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull()
                    ->label('Layout')
                    ->placeholder('Opening'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
            ]);
    }

    public static function table(Table $table): Table {
        $title = 'Layout';
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        Split::make([
                            TextColumn::make('initial')
                                ->sortable()
                                ->searchable()
                                ->grow(false)
                                ->label('Initial')
                        ]),
                        TextColumn::make('name')
                            ->sortable()
                            ->searchable()
                            ->label('Layout')
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
            'index' => Pages\ManageLayouts::route('/'),
        ];
    }
}
