<?php

namespace App\Filament\Resources\DigitalInvitation\Setting;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Tables\Columns\Layout\Split as TableSplit;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Clusters\DigitalInvitation\Setting;
use App\Models\DigitalInvitation\Setting\EventTypeLayout;
use App\Filament\Resources\DigitalInvitation\Setting\EventTypeLayoutResource\Pages;

class EventTypeLayoutResource extends Resource
{
    protected static ?string $model = EventTypeLayout::class;

    protected static ?string $cluster = Setting::class;
    protected static ?string $slug = 'event-type-layout';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTX001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('event_type_id')
                            ->relationship('eventType', 'event_type')
                            ->preload()
                            ->searchable(),
                        Repeater::make('layouts')
                            ->schema([
                                Select::make('layout_id')
                                    ->relationship('layout', 'layout_name')
                                    ->label('Layout Name')
                                    ->preload()
                                    ->searchable()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->required()
                            ])
                            ->label('Arrange Layout')
                            ->addActionLabel('Add More Layout')
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSplit::make([
                    TextColumn::make('eventType.event_type')
                        ->label('Event Type')
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
                'xl' => 3,
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Choose Menu', Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Menu', null, null, null)
            ])
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose Menu', Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Choose Menu', Icons::ADD, false, false)
            ])
            ->defaultPaginationPageOption(10)
            ->striped()
            ->heading('Setting Event Type Layout')
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventTypeLayouts::route('/'),
            'create' => Pages\CreateEventTypeLayout::route('/create'),
            'edit' => Pages\EditEventTypeLayout::route('/{record}/edit'),
        ];
    }
}
