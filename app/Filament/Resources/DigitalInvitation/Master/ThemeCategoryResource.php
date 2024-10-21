<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use App\Enums\Icons;
use Filament\Tables;
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
use App\Models\DigitalInvitation\Master\ThemeCategory;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\ThemeCategoryResource\Pages;

class ThemeCategoryResource extends Resource
{
    protected static ?string $model = ThemeCategory::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'theme-category';
    protected static ?string $navigationLabel = 'Theme Category';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTM002';
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
                    ->placeholder('TC001')
                    ->unique(ignoreRecord: true)
                    ->default(fn () => ThemeCategory::generateCode()),
                TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull()
                    ->label('Theme Category')
                    ->placeholder('Elegant'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
            ]);
    }

    public static function table(Table $table): Table
    {
        $title = 'Theme Category';
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
                            ->label('Theme Category')
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
            'index' => Pages\ManageThemeCategories::route('/'),
        ];
    }
}
