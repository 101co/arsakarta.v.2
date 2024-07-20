<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use GuzzleHttp\Psr7\MimeType;
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
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Model;

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
        $types = app(MimeType::class);

        $acceptedAudioTypes = [
            $types->fromExtension('mp3'),
            $types->fromExtension('wav')
        ];

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
                    ->acceptedFileTypes($acceptedAudioTypes)
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
                Split::make([
                    Stack::make([
                    ImageColumn::make('song_image')
                        ->label('Images')
                        ->circular()
                        ->visibleFrom('md')

                    ])
                    ->grow(false),
                    Stack::make([
                        TextColumn::make('song_title')
                            ->label('Title')
                            ->searchable()
                            ->sortable()
                            ->grow(false),
                        TextColumn::make('song_by_user')
                            ->label('Uploaded By')
                            ->badge()
                            ->formatStateUsing(fn (bool $state) => match($state)
                            {
                                true => 'User',
                                false => 'Admin'
                            })
                            ->color(fn (bool $state) => match ($state)
                            {   
                                true => 'success',
                                false => 'warning'
                            }),
                        ]),
                    Stack::make([
                        ToggleColumn::make('is_active')
                            ->label('Is Active')
                    ])
                ])
            ])
            ->filters([])
            ->contentGrid([
                'sm' => 1,
                'xl' => 2
            ])
            ->actions([
                    getCustomTableAction(ActionType::EDIT, 'Update', 'Update Theme', Icons::EDIT, null, false),
                    getCustomTableAction(ActionType::DELETE, null, 'Delete Theme', null, null, null)
                ], ActionsPosition::BeforeCells)
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
