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
use App\Filament\Clusters\DigitalInvitation\Master;
use App\Models\DigitalInvitation\Master\EventCategory;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\EventCategoryResource\Pages;

class EventCategoryResource extends Resource
{
    protected static ?string $model = EventCategory::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'event-category';
    protected static ?string $navigationLabel = 'Event Category';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTM001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('initial')
                    ->required()
                    ->maxLength(5)
                    ->columnSpanFull()
                    ->label('Initial')
                    ->placeholder('EC001')
                    ->unique(ignoreRecord: true)
                    ->default(fn () => EventCategory::generateCode()),
                TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull()
                    ->label('Event Category')
                    ->placeholder('Wedding'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
            ]);
    }

    public static function table(Table $table): Table
    {
        $title = 'Event Category';
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        TextColumn::make('initial')
                            ->sortable()
                            ->searchable()
                            ->label('Initial'),
                        TextColumn::make('name')
                            ->sortable()
                            ->searchable()
                            ->label('Event Category')
                            ->weight(FontWeight::SemiBold)
                            ->size(TextColumnSize::Medium)
                    ])
                    ->space(1),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEventCategories::route('/'),
        ];
    }
}
