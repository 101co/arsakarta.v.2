<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\ActionsPosition;
use App\Models\DigitalInvitation\Master\Theme;
use App\Filament\Clusters\DigitalInvitation\Master;
use App\Filament\Resources\DigitalInvitation\Master\Themes\Pages\ManageThemes;
use Filament\Tables\Columns\ImageColumn;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'theme';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 5;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTM005';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('theme_category_id')
                    ->relationship(name: 'themeCategory', titleAttribute: 'theme_category_name')
                    ->createOptionForm([
                        TextInput::make('theme_category_name')
                            ->required()
                            ->maxLength(100)
                    ])
                    ->columnSpanFull()
                    ->maxWidth(MaxWidth::Medium),
                TextInput::make('theme_name')
                    ->label('Theme Name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100)
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->columnSpanFull()
                    ->reorderable()
                    ->maxFiles(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('theme_name')
                    ->label('Theme Name')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('images')
                    ->label('Images')
                    ->circular()
                    ->stacked(),
                ToggleColumn::make('is_active')
                    ->label('Is Active')
            ])
            ->filters([])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update Theme', Icons::EDIT, null, false),
                getCustomTableAction(ActionType::DELETE, null, 'Delete Theme', null, null, null)
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null)
            ])
            ->headerActions([
                getCustomTableAction(ActionType::CREATE, 'Add', 'Add Theme', Icons::ADD, false, false)
            ])
            ->emptyStateActions([
                getCustomTableAction(ActionType::CREATE, 'Add', null, Icons::ADD, false, false)
            ])
            ->defaultPaginationPageOption(10)
            ->heading('Theme')
            ->deferLoading()
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageThemes::route('/'),
        ];
    }
}
