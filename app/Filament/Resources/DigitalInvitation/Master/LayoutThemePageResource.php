<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Clusters\DigitalInvitation\Master;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Models\DigitalInvitation\Master\LayoutThemePage;
use App\Filament\Resources\DigitalInvitation\Master\LayoutThemePageResource\Pages;
use App\Models\DigitalInvitation\Master\ThemeCategory;

class LayoutThemePageResource extends Resource
{
    protected static ?string $model = LayoutThemePage::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'layout-theme-page';
    protected static ?string $navigationLabel = 'Layout Theme Page';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 6;

    public static function canViewAny(): bool {
        $menuCode = 'INVTM006';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('initial')
                    ->required()
                    ->maxLength(6)
                    ->columnSpanFull()
                    ->label('Initial')
                    ->placeholder('LTP001')
                    ->unique(ignoreRecord: true)
                    ->default(fn () => LayoutThemePage::generateCode()),
                TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull()
                    ->label('Layout Name')
                    ->placeholder('Opening Layout Blade'),
                Select::make('theme_master_id')
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
                Select::make('layout_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->relationship(name: 'layout', titleAttribute: 'name'),
                TextInput::make('page_name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull()
                    ->label('Layout Name')
                    ->placeholder('Opening Layout Blade'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
            ]);
    }

    public static function table(Table $table): Table {
        $title = 'Layout Theme Page';
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
                            TextColumn::make('themeMaster.name')
                                ->badge()
                                ->color('success')
                        ]),
                        TextColumn::make('layout.name')
                            ->sortable()
                            ->searchable()
                            ->label('Layout')
                            ->size(TextColumnSize::Small),
                        TextColumn::make('name')
                            ->sortable()
                            ->searchable()
                            ->label('Layout Name')
                            ->weight(FontWeight::SemiBold)
                            ->size(TextColumnSize::Medium)
                    ])
                    ->space(2),
                    ToggleColumn::make('is_active')
                        ->alignEnd()
                        ->label('Active')
                ])
            ])
            ->filters([
                SelectFilter::make('theme_master_id')
                    ->label('Theme')
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
                    })
            ])
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
            'index' => Pages\ManageLayoutThemePages::route('/'),
        ];
    }
}
