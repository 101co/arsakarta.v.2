<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use Filament\Forms;
use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Models\DigitalInvitation\Master\Theme;
use App\Filament\Clusters\DigitalInvitation\Master;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\DigitalInvitation\Master\ThemeCategory;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\ThemeResource\Pages;
use App\Filament\Resources\DigitalInvitation\Master\ThemeResource\RelationManagers;
use App\Models\DigitalInvitation\Master\LayoutThemePage;
use Filament\Forms\Get;
use Filament\Tables\Filters\Filter;

class ThemeResource extends Resource {
    protected static ?string $model = Theme::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'theme';
    protected static ?string $navigationLabel = 'Theme';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 7;

    public static function canViewAny(): bool {
        $menuCode = 'INVTM007';
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
                    ->placeholder('TC001')
                    ->unique(ignoreRecord: true)
                    ->default(fn () => Theme::generateCode()),
                Select::make('theme_master_id')
                    ->live()
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->options(function() {
                        $options = [];
                        $themeCategories = ThemeCategory::with(['themeMaster'])->get();
                        foreach ($themeCategories as $themeCategory) {
                            $options[$themeCategory->name] = collect($themeCategory->themeMaster)->mapWithKeys(function ($category) {
                                return [$category->id => $category->name];
                            })->toArray();
                        }
                        return $options;
                    }),
                Select::make('package_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->relationship('package', 'name'),
                Select::make('event_category_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->relationship('eventCategory', 'name'),
                FileUpload::make('image')
                    ->columnSpanFull(),
                Checkbox::make('is_show_demo')
                    ->default(false)
                    ->columnSpanFull()
                    ->label('Display For Demo'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
                    ->columnSpanFull(),
                Section::make([
                        CheckboxList::make('layouts')
                            ->options(function(Get $get) {
                                $layoutThemePage = [];
                                
                                if (!is_null($get('theme_master_id'))) {
                                    $layoutThemePage = LayoutThemePage::where('is_active', '=', true)
                                                        ->where('theme_master_id', '=', $get('theme_master_id'))
                                                        ->get()->pluck('name', 'id');
                                }
                                return $layoutThemePage;
                            })
                            ->noSearchResultsMessage('Not found')
                            ->searchable()
                            ->columns(1)
                    ])
                    ->collapsible()
                    ->heading('Layout')
            ]);
    }

    public static function table(Table $table): Table {
        $title = 'Theme';
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
                            TextColumn::make('package.name')
                                ->badge()
                                ->color('info'),
                        ]),
                        TextColumn::make('themeMaster.name')
                            ->size(TextColumnSize::Medium)
                            ->weight(FontWeight::SemiBold),
                        TextColumn::make('eventCategory.name')
                            ->sortable()
                            ->searchable()
                            ->badge()
                            ->color('danger')
                            ->weight(FontWeight::ExtraLight)
                            ->size(TextColumnSize::ExtraSmall)
                    ])
                    ->space(2),
                    ToggleColumn::make('is_active')
                        ->alignEnd()
                        ->label('Active')
                ])
            ])
            ->filters([
                SelectFilter::make('theme_master_id')
                    ->label('Theme Master')
                    ->searchable()
                    ->preload()
                    ->options(function() {
                        $options = [];
                        $themeCategories = ThemeCategory::with(['themeMaster'])->get();
                        foreach ($themeCategories as $themeCategory) {
                            $options[$themeCategory->name] = collect($themeCategory->themeMaster)->mapWithKeys(function ($category) {
                                return [$category->id => $category->name];
                            })->toArray();
                        }
                        return $options;
                    }),
                SelectFilter::make('eventCategory')
                    ->label('Event Category')
                    ->searchable()
                    ->preload()
                    ->relationship('eventCategory', 'name'),
                SelectFilter::make('package')
                    ->label('Package')
                    ->searchable()
                    ->preload()
                    ->relationship('package', 'name'),
                Filter::make('is_show_demo')
                    ->label('Display For Demo')
                    ->query(fn (Builder $query): Builder => $query->where('is_show_demo', true))
            ])
            ->contentGrid([
                'sm' => 1,
                'xl' => 2,
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
            'index' => Pages\ManageThemes::route('/'),
        ];
    }
}
