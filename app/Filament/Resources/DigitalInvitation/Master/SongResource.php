<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\ActionsPosition;
use App\Models\DigitalInvitation\Master\Song;
use App\Filament\Clusters\DigitalInvitation\Master;
use App\Filament\Resources\DigitalInvitation\Master\SongResource\Pages;

class SongResource extends Resource
{
    protected static ?string $model = Song::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'song';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 6;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTM006';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('song_title')
                    ->label('Title')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100)
                    ->columnSpanFull(),
                FileUpload::make('song_filename')
                    ->label('Song File (.mp3)')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('song_image')
                    ->label('Cover Image')
                    ->image()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('song_title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('song_image')
                    ->label('Images')
                    ->circular(),
                TextColumn::make('song_by_user')
                    ->label('Upload User')
                    ->badge(),
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
            ->heading('Song')
            ->deferLoading()
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSongs::route('/'),
        ];
    }
}
