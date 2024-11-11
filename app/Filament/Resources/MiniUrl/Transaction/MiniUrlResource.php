<?php

namespace App\Filament\Resources\MiniUrl\Transaction;

use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Enums\ActionsPosition;
use App\Models\MiniUrl\Transaction\MiniUrl;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Clusters\MiniUrl\Transaction;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\MiniUrl\Transaction\MiniUrlResource\Pages;
use Filament\Forms\Components\Hidden;

class MiniUrlResource extends Resource
{
    protected static ?string $model = MiniUrl::class;
    public ?array $data = [];
    protected static ?string $cluster = Transaction::class;
    protected static ?string $slug = 'url';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = Icons::DEFAULT->value;
    protected static ?string $navigationLabel = 'Mini Url';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        $menuCode = 'MINURT001';
        return authUserMenu($menuCode, auth()->user()->id);
    }

    public static function form(Form $form): Form {
        $qrCode = function() { return 'asu'; };
        return $form
            ->schema([
                TextInput::make('original_url')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->url()
                    ->reactive()
                    ->helperText(fn (Get $get) => env('APP_URL').'/url/'.$get('short_url'))
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $set('short_url', substr(md5($get('original_url') .microtime()), 0, 6));
                    })
                    ->columnSpanFull(),
                Hidden::make('short_url'),
            ]);
    }

    public static function table(Table $table): Table {
        $pageTitle = 'Mini Url';
        return $table
            ->columns([
                TextColumn::make('original_url')
                    ->label('Original Url')
                    ->searchable()
                    ->sortable()
                    ->grow(false),
                TextColumn::make('short_url')
                    ->label('Mini Url')
                    ->weight(FontWeight::Thin)
                    ->size(TextColumnSize::ExtraSmall)
                    ->copyable()
                    ->copyableState(fn (string $state): string => env('APP_URL')."/url/{$state}")
                    ->prefix(env('APP_URL').'/url/'),
            ])
            ->filters([
            ])
            ->persistFiltersInSession()
            ->contentGrid([
            ])
            ->actions([
                getCustomTableAction(ActionType::EDIT, 'Update', 'Update '.$pageTitle, Icons::EDIT, null, false, true),
                getCustomTableAction(ActionType::DELETE, null, 'Delete '.$pageTitle, null, null, null, true)
            ], position: ActionsPosition::AfterColumns)
            ->bulkActions([
                getCustomTableAction(ActionType::BULK_DELETE, null, null, null, null, null, true)
            ])
            ->headerActions([
                // getCustomTableAction(ActionType::CREATE, 'Add', $pageTitle, Icons::ADD, false, false, true)
                CreateAction::make()
                    ->mutateFormDataUsing((function (array $data): array {
                        try {
                            $data['user_id'] = auth()->user()->id;
                            $data['created_by'] = auth()->user()->username;
                            $data['updated_by'] = auth()->user()->username;
                            return $data;
                        } catch (\Throwable $th) {
                            dd($th);
                        }
                    }))
                    ->label('Add')
                    ->slideOver(false)
                    ->icon(Icons::ADD->value)
                    ->iconSize(IconSize::Small)
                    ->modalHeading('Mini Url')
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
            ->defaultPaginationPageOption(10)
            ->persistColumnSearchesInSession()
            ->heading($pageTitle)
            ->deferLoading()
            ->striped();
    }

    public function copyToClipboard() {
        dump('copy');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMiniUrls::route('/'),
        ];
    }
}
