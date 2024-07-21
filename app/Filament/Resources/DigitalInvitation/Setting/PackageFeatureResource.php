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
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Clusters\DigitalInvitation\Setting;
use Filament\Tables\Columns\Layout\Split as TableSplit;
use App\Models\DigitalInvitation\Setting\PackageFeature;
use App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Stack;

class PackageFeatureResource extends Resource
{
    protected static ?string $model = PackageFeature::class;

    protected static ?string $cluster = Setting::class;
    protected static ?string $slug = 'package-feature';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTX002';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Split::make([
                Section::make([
                    Section::make('Layout')
                        ->schema([
                            Select::make('event_type_id')
                                ->required()
                                ->relationship('eventType', 'event_type')
                                ->preload()
                                ->unique(PackageFeature::class, 'id', null, $ignoreRecord = true, $modifyRuleUsing = function (Unique $rule, string $context, ?Model $record) {
                                    if ($record)
                                    {
                                        return $rule
                                            ->where('event_type_id', $record->event_type_id)
                                            ->whereNot('id', $record->id);
                                    }
        
                                    return false;
                                })
                                ->searchable(),
                            Select::make('package_id')
                                ->relationship('package', 'package_name')
                                ->preload()
                                ->unique(PackageFeature::class, 'id', null, $ignoreRecord = true, $modifyRuleUsing = function (Unique $rule, string $context, ?Model $record) {
                                    if ($record)
                                    {
                                        return $rule
                                            ->where('package_id', $record->package_id)
                                            ->whereNot('id', $record->id);
                                    }
        
                                    return null;
                                })
                                ->searchable(),
                            TextInput::make('price')
                                ->required()
                                ->prefix('IDR'),
                        ]),
                    Section::make('Features')
                        ->schema([
                            Repeater::make('features')
                                ->schema([
                                    Select::make('feature_id')
                                        ->relationship('feature', 'feature_name')
                                        ->label('Feature')
                                        ->preload()
                                        ->searchable()
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                        ->required(),
                                    TextInput::make('value')
                                        ->required()
                                ])
                                ->label('Arrange Feature')
                                ->addActionLabel('Add More Feature')
                        ])
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSplit::make([
                    Stack::make([
                        TableSplit::make([
                            TextColumn::make('eventType.event_type')
                                ->label('Event Type')
                                ->badge()
                                ->color('success'),
                            TextColumn::make('package.package_name')
                                ->label('Package Name')
                                ->badge()
                                ->color('primary')
                                ->searchable()
                                ->sortable(),
                        ]),
                        TableSplit::make([
                            TextColumn::make('price')
                                ->label('Price')
                                ->weight(FontWeight::ExtraBold)
                                ->money('IDR')
                                ->searchable()
                                ->sortable()
                        ])
                    ]),
                    ToggleColumn::make('is_active')
                        ->label('Is Active')
                        ->alignEnd()
                ])
            ])
            ->groups([
                'eventType.event_type'
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
            'index' => Pages\ListPackageFeatures::route('/'),
            'create' => Pages\CreatePackageFeature::route('/create'),
            'edit' => Pages\EditPackageFeature::route('/{record}/edit'),
        ];
    }
}
