<?php

namespace App\Filament\Resources\DigitalInvitation\Master;

use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Enums\ActionType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\File;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Models\DigitalInvitation\Master\Theme;
use App\Filament\Clusters\DigitalInvitation\Master;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\DigitalInvitation\Master\ThemeResource\Pages;

class ThemeResource extends Resource {
    protected static ?string $model = Theme::class;

    protected static ?string $cluster = Master::class;
    protected static ?string $slug = 'theme';
    protected static ?string $navigationLabel = 'Theme';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 7;

    public static function canViewAny(): bool {
        $menuCode = 'INVTM007';
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
                    ->default(fn () => Theme::generateCode()),
                Select::make('theme_category')
                    ->searchable()
                    ->columnSpanFull()
                    ->label('Theme Category')
                    ->live()
                    ->options(function () {
                        $folders = File::directories(resource_path('views/livewire/digital-invitation/themes'));
                        $options = [];
                
                        foreach ($folders as $folder) {
                            // Mengambil nama folder dari path
                            $folderName = basename($folder);
                            $options[$folderName] = ucfirst($folderName); // Menggunakan nama folder sebagai label
                        }
                
                        return $options;
                    })
                    ->required(),
                Select::make('theme_name')
                    ->searchable()
                    ->columnSpanFull()
                    ->label('Theme')
                    ->live()
                    ->options(function (Get $get) {
                        $folders = File::directories(resource_path('views/livewire/digital-invitation/themes/'.$get('theme_category')));
                        $options = [];
                
                        foreach ($folders as $folder) {
                            // Mengambil nama folder dari path
                            $folderName = basename($folder);
                            $options[$folderName] = ucfirst($folderName); // Menggunakan nama folder sebagai label
                        }
                
                        return $options;
                    })
                    ->required(),
                Select::make('package_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->relationship('package', 'name'),
                Select::make('event_category_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->relationship('eventCategory', 'name'),
                FileUpload::make('image')
                    ->columnSpanFull(),
                Checkbox::make('is_show_demo')
                    ->default(false)
                    ->columnSpanFull()
                    ->label('Display For Demo'),
                Checkbox::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active')
                    ->columnSpanFull(),
                Section::make([
                        CheckboxList::make('layouts')
                            ->options(function(Get $get) {
                                $files = File::files(resource_path('views/livewire/digital-invitation/themes/'.$get('theme_category').'/'.$get('theme_name')));
                                $options = [];
                        
                                foreach ($files as $file) {
                                    // Mengambil nama folder dari path
                                    $fileName  = basename($file, '.blade.php');
                                    $options[$fileName ] = ucfirst($fileName ); // Menggunakan nama folder sebagai label
                                }
                        
                                return $options;
                            })
                            ->noSearchResultsMessage('Not found')
                            ->searchable()
                            ->columns(1)
                    ])
                    ->collapsible()
                    ->heading('Layout')
            ]);
    }

    public static function table(Table $table): Table {
        $title = 'Theme';
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
                            TextColumn::make('package.name')
                                ->badge()
                                ->color('info'),
                        ]),
                        TextColumn::make('themeMaster.name')
                            ->size(TextColumnSize::Medium)
                            ->weight(FontWeight::SemiBold),
                        TextColumn::make('eventCategory.name')
                            ->sortable()
                            ->searchable()
                            ->badge()
                            ->color('danger')
                            ->weight(FontWeight::ExtraLight)
                            ->size(TextColumnSize::ExtraSmall)
                    ])
                    ->space(2),
                    ToggleColumn::make('is_active')
                        ->alignEnd()
                        ->label('Active')
                ])
            ])
            ->filters([
                SelectFilter::make('eventCategory')
                    ->label('Event Category')
                    ->searchable()
                    ->preload()
                    ->relationship('eventCategory', 'name'),
                SelectFilter::make('package')
                    ->label('Package')
                    ->searchable()
                    ->preload()
                    ->relationship('package', 'name'),
                Filter::make('is_show_demo')
                    ->label('Display For Demo')
                    ->query(fn (Builder $query): Builder => $query->where('is_show_demo', true))
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
                            // dd($data);
                            return $data;
                        } catch (\Throwable $th) {
                            dd($th);
                        }
                    }))
                    ->label('Add')
                    ->slideOver(false)
                    ->icon(Icons::ADD->value)
                    ->iconSize(IconSize::Small)
                    ->modalHeading('Add')
                    ->modalWidth(MaxWidth::Large)
                    ->modalSubmitActionLabel('Add')
                    ->stickyModalFooter()
                    ->stickyModalHeader()
                    ->createAnother(false)
                    ->modalCancelAction(null)
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
            'index' => Pages\ManageThemes::route('/'),
        ];
    }
}
