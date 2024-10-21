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
use App\Filament\Clusters\DigitalInvitation\Master;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\DigitalInvitation\Master\ThemeMaster;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\ThemeMasterResource\Pages;
use App\Filament\Resources\DigitalInvitation\Master\ThemeMasterResource\RelationManagers;

class ThemeMasterResource extends Resource {
    protected static ?string $model = ThemeMaster::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'theme-master';
    protected static ?string $navigationLabel = 'Theme Master';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool {
        $menuCode = 'INVTM003';
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
                    ->default(fn () => ThemeMaster::generateCode()),
                Select::make('theme_category_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->relationship(name: 'themeCategory', titleAttribute: 'name'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->columnSpanFull()
                    ->label('Theme')
                    ->placeholder('National Elegant'),
                FileUpload::make('image')
                    ->columnSpanFull(),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
            ]);
    }

    public static function table(Table $table): Table {
        $title = 'Theme Master';
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
            ->filters([
                SelectFilter::make('theme_category_id')
                    ->label('Theme Category')
                    ->searchable()
                    ->preload()
                    ->relationship('themeCategory', 'name')
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

    public static function getPages(): array {
        return [
            'index' => Pages\ManageThemeMasters::route('/'),
        ];
    }
}
