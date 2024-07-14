<?php

namespace App\Filament\Resources\SystemManager\Master;

use Filament\Forms;
use App\Enums\Icons;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Clusters\SystemManager\Master;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemManager\Master\UserResource\Pages;
use App\Filament\Resources\SystemManager\Master\UserResource\RelationManagers;
use Filament\Forms\Components\Split;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'user';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 5;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKM005';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make()
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->columns(2),
                            TextInput::make('username')
                                ->unique(ignoreRecord: true)
                                ->required(),
                            TextInput::make('email')
                                ->email()
                                ->required(),
                            TextInput::make('password')
                                ->password()
                                ->required(),
                            FileUpload::make('avatar')
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->circular()
                    ->defaultImageUrl(url('images/placeholder.png'))
                    ->label(''),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('username')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
            ])
            ->filters([])
            ->actions([
                EditAction::make()
                    ->tooltip('edit')
                    ->hiddenLabel()
                    ->icon(Icons::EDIT->value),
                DeleteAction::make()
                    ->tooltip('delete')
                    ->hiddenLabel(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                DeleteBulkAction::make()
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add')
                    ->icon(Icons::ADD->value)
            ])
            ->emptyStateActions([
                CreateAction::make()
                    ->label('Add')
                    ->icon(Icons::ADD->value)

            ])
            ->defaultPaginationPageOption(10)
            ->striped()
            ->heading('User')
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
