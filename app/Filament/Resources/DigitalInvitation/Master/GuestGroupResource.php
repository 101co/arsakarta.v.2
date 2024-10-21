<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use Filament\Forms;
use App\Enums\Icons;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\DigitalInvitation\Master;
use App\Models\DigitalInvitation\Master\GuestGroup;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\GuestGroupResource\Pages;
use App\Filament\Resources\DigitalInvitation\Master\GuestGroupResource\RelationManagers;

class GuestGroupResource extends Resource {
    protected static ?string $model = GuestGroup::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'guest-group';
    protected static ?string $navigationLabel = 'Guest Group';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 9;

    public static function canViewAny(): bool {
        $menuCode = 'INVTM009';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100)
                    ->columnSpanFull()
                    ->label('Guest Group')
                    ->placeholder('Ungroup'),
                Checkbox::make('is_for_all')
                    ->required()
                    ->default(true)
                    ->columnSpanFull()
                    ->label('Display For All'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        $title = 'Guest Group';
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        TextColumn::make('name')
                            ->sortable()
                            ->searchable()
                            ->label('Guest Group')
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
                // getCustomTableAction(ActionType::CREATE, 'Add', 'Add '.$title, Icons::ADD, false, false, true)
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
            'index' => Pages\ManageGuestGroups::route('/'),
        ];
    }
}
