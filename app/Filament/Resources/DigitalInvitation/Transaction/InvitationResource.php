<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction;

use App\Enums\Icons;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Columns\Layout\Split as TableSplit;
use App\Filament\Clusters\DigitalInvitation\Transaction;
use App\Models\DigitalInvitation\Transaction\Invitation;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

class InvitationResource extends Resource
{
    protected static ?string $model = Invitation::class;

    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'invitation';
    protected static ?string $navigationLabel = 'Undanganmu';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'INVTT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSplit::make([
                    Stack::make([
                        TextColumn::make('event_name')
                            ->label('Event Name')
                            ->weight(FontWeight::Medium), 
                        TableSplit::make([
                            TextColumn::make('package.package_name')
                                ->badge()
                                ->grow(false),
                            TextColumn::make('slug')
                                ->label('Slug')
                                ->weight(FontWeight::Thin)
                                ->size(TextColumnSize::ExtraSmall)
                                ->copyable()
                                ->copyableState(fn (string $state): string => "https://arsakarta.com/{$state}")
                                ->prefix('https://arsakarta.com/'),
                        ]),
                    ]),
                    Stack::make([ 
                        ToggleColumn::make('is_active')
                            ->label('Is Active')
                            ->alignEnd()
                    ]),
                ])
            ])
            ->filters([])
            ->contentGrid([
                'sm' => 1,
                'xl' => 2,
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
            ->modifyQueryUsing(function (Builder $query) 
            { 
                return $query->where('user_id', auth()->user()->id); 
            }) 
            ->defaultPaginationPageOption(10)
            ->heading('Invitation')
            ->recordUrl(null)
            ->deferLoading()
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvitations::route('/'),
            'create' => Pages\InvitationAdd::route('/create'),
            'edit' => Pages\InvitationAdd::route('/{record}/edit'),
        ];
    }
}
