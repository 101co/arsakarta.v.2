<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction;

use App\Enums\Icons;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Layout\Split as TableSplit;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Clusters\DigitalInvitation\Transaction;
use App\Models\DigitalInvitation\Transaction\Invitation;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

class InvitationResource extends Resource {
    protected static ?string $model = Invitation::class;

    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'invitation';
    protected static ?string $navigationLabel = 'Undangan';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool {
        $menuCode = 'INVTT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function table(Table $table): Table {
        $title = 'Undangan';
        return $table
            ->columns([
                TableSplit::make([
                    Stack::make([
                        TextColumn::make('name')
                            ->label('Invitation Name')
                            ->weight(FontWeight::Bold)
                            ->size(TextColumnSize::Medium), 
                        TextColumn::make('package.name')
                            ->badge()
                            ->color(fn(string $state): string => match($state) {
                                'Free Trial'    => 'danger',
                                'Gold'          => 'warning',
                                'Platinum'      => 'info'
                            })
                            ->grow(false),
                        TextColumn::make('slug')
                            ->label('Slug')
                            ->weight(FontWeight::Thin)
                            ->size(TextColumnSize::ExtraSmall)
                            ->copyable()
                            ->copyableState(fn (string $state): string => env('APP_URL')."/{$state}")
                            ->prefix(env('APP_URL').'/'),
                    ])
                    ->space(2),
                    Stack::make([ 
                        ToggleColumn::make('is_active')
                            ->label('Is Active')
                            ->alignEnd()
                    ]),
                ])
            ])
            ->filters([
                // SelectFilter::make('event_category_id')
                //     ->label('Event Category')
                //     ->relationship('eventCategory', 'name')
                //     ->searchable()
                //     ->preload()
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
                CreateAction::make()
                    ->mutateFormDataUsing((function (array $data): array {
                        try {
                            $data['created_by'] = auth()->user()->username;
                            $data['updated_by'] = auth()->user()->username;
                            $data['user_id'] = auth()->user()->id;
                            dd('here');
                            return $data;
                        } catch (\Throwable $th) {
                            dd($th);
                        }
                    }))
                    ->label('Add')
                    ->slideOver(false)
                    ->icon(Icons::ADD->value)
                    ->iconSize(IconSize::Small)
                    ->modalHeading('Add '.$title)
                    ->modalWidth(MaxWidth::Large)
                    ->modalSubmitActionLabel('Add')
                    ->stickyModalFooter()
                    ->stickyModalHeader()
                    ->createAnother(false)
                    ->modalCancelAction(false)
                    ->size(ActionSize::Small)
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

    public static function getRelations(): array {
        return [];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListInvitations::route('/'),
            'create' => Pages\CreateInvitationCustom::route('/create'),
            'edit' => Pages\CreateInvitationCustom::route('/{record}/edit'),
            // 'edit' => Pages\EditInvitation::route('/{record}/edit'),
        ];
    }
}
