<?php

namespace App\Filament\Resources\SystemManager\Master;

use App\Enums\Icons;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Models\SystemManager\Master\Role;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Clusters\SystemManager\Master;
use App\Filament\Resources\SystemManager\Master\RoleResource\Pages;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'role';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-c-shield-check';
    protected static ?int $navigationSort = 4;

    public static function canViewAny(): bool
    {
        $menuCode = 'ARSKM004';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('role')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('description')
                            ->maxLength(255)
                            ->required()
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('role')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
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
            ->heading('Role')
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
