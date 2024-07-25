<?php

namespace App\Filament\Resources\DigitalInvitation\Setting;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Models\DigitalInvitation\Master\Package;
use App\Filament\Clusters\DigitalInvitation\Setting;
use Filament\Tables\Columns\Layout\Split as TableSplit;
use App\Models\DigitalInvitation\Setting\EventTypeLayout;
use App\Filament\Resources\DigitalInvitation\Setting\EventTypeLayoutResource\Pages;
use App\Models\DigitalInvitation\Master\Layout;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\CheckboxColumn;

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
                            ->unique(EventTypeLayout::class, 'id', null, $ignoreRecord = true, $modifyRuleUsing = function (Unique $rule, string $context, ?Model $record) {
                                if ($record)
                                {
                                    return $rule
                                        ->where('event_type_id', $record->event_type_id)
                                        ->whereNot('id', $record->id);
                                }
    
                                return null;
                            })
                            ->searchable(),
                        Repeater::make('layouts')
                            ->schema([
                                Select::make('layout_id')
                                    ->relationship('layout', 'layout_name')
                                    ->label('Layout Name')
                                    ->preload()
                                    ->searchable()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->required(),
                                CheckboxList::make('packages')
                                    ->options(getAllPackageActive(true))
                                    ->required()
                                    ->bulkToggleable()
                                    ->gridDirection('row')
                                    ->columns(3)
                                    ->columnSpanFull(),
                            ])
                            ->label('Arrange Layout')
                            ->addActionLabel('Add More Layout')
                            ->collapsible()
                            ->collapsed()
                            ->itemLabel(fn (array $state): ?string => $state['layout_id'] ? Layout::where('id', '=', $state['layout_id'])->pluck('layout_name')->first()  : null)
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
            ->recordUrl(null)
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
            ->heading('Setting Event Type Layout')
            ->deferLoading()
            ->striped();
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
