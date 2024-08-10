<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use GuzzleHttp\Psr7\MimeType;
use Filament\Resources\Pages\Page;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Split;
use Filament\Support\Enums\IconSize;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\DigitalInvitation\Master\Song;
use App\Models\DigitalInvitation\Master\Theme;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\DigitalInvitation\Master\Package;
use App\Models\DigitalInvitation\Master\EventType;
use App\Models\DigitalInvitation\Setting\PackageFeature;
use App\Models\DigitalInvitation\Transaction\Invitation;
use Filament\Forms\Components\Actions\Action as FormAction;
use Hugomyb\FilamentMediaAction\Forms\Components\Actions\MediaAction;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource;

class InvitationAdd extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $dataku = 'test';
    public Set $set;

    protected static string $resource = InvitationResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function form(Form $form): Form
    {
        $types = app(MimeType::class);

        $acceptedAudioTypes = [
            $types->fromExtension('mp3'),
            $types->fromExtension('wav')
        ];
        
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('General')
                            ->icon(Icons::GEAR->value)
                            ->schema([
                                Split::make([
                                    Section::make('Pengaturan Undangan')
                                        ->collapsible()
                                        ->icon(Icons::GEAR->value)
                                        ->iconSize(IconSize::Small)
                                        ->schema([
                                            Select::make('selected_event_type_id')
                                                ->required()
                                                ->placeholder('Pilih Tipe Undangan')
                                                ->hiddenLabel()
                                                ->options(EventType::where('is_active', '=', true)->pluck('event_type', 'id'))
                                                ->live()
                                                ->afterStateUpdated(function (Set $set) {
                                                    $set('selected_package_id', null);
                                                })
                                                ->searchable()
                                                ->getSearchResultsUsing(fn (string $search): array => EventType::where('event_type', 'like', "%{$search}%")->limit(50)->pluck('event_type', 'id')->toArray()),
                                            TextInput::make('event_name')
                                                ->required()
                                                ->live(onBlur:true)
                                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                                ->hiddenLabel()
                                                ->placeholder('Nama Undangan'),
                                            TextInput::make('slug')
                                                ->required()
                                                ->hiddenLabel()
                                                ->live()
                                                ->unique()
                                                ->afterStateUpdated(function (HasForms $livewire, TextInput $component) 
                                                {
                                                    $livewire->validate($component->getStatePath());
                                                })
                                                ->placeholder('Slug')
                                                ->disabled(fn (Get $get): bool => !filled($get('event_name')))
                                                ->helperText(fn (Get $get) => 'https://arsakarta.com/'.$get('slug'))
                                        ]),

                                    Section::make('Paket Undangan')
                                        ->collapsible()
                                        ->icon(Icons::TICKET->value)
                                        ->iconSize(IconSize::Small)
                                        ->columnSpanFull()
                                        ->schema([
                                            TextInput::make('no_type_selected')
                                                ->hiddenLabel()
                                                ->disabled()
                                                ->default('Silahkan pilih tipe undangan terlebih dahulu...')
                                                ->hidden(fn(Get $get) => !empty($get('selected_event_type_id'))),
                                            Radio::make('selected_package_id')
                                                ->hiddenLabel()
                                                ->live()
                                                ->options(fn(Get $get) => !empty($get('selected_event_type_id')) ? PackageFeature::where('event_type_id', $get('selected_event_type_id'))->get()->pluck('package.package_name', 'package.id') : null)
                                                ->descriptions(function(Get $get) {
                                                    if(!empty($get('selected_event_type_id')))
                                                    {
                                                        $price = PackageFeature::where('event_type_id', $get('selected_event_type_id'))->get()->pluck('price', 'package.id');
                                                        $formatedPrice = [];

                                                        foreach ($price as $item => $entry)
                                                        {
                                                            $price[$item] = 'IDR '. number_format($price[$item], 0);
                                                        }
                                                        return $price;
                                                    }
                                                    return null;
                                                }),
                                        ])
                                        ->headerActions([
                                            FormAction::make('upgrade')
                                                ->label('Info Paket')
                                                ->disabled(fn(Get $get) => empty($get('selected_event_type_id')))
                                                ->link()
                                                ->icon(Icons::INFO->value)
                                        ])
                                        ->footerActionsAlignment(Alignment::End)
                                        ->footerActions([
                                            FormAction::make('choose')
                                                ->label('Pilih Paket')
                                                ->icon(Icons::CHECK->value)
                                                ->disabled(fn(Get $get) => empty($get('selected_package_id')) ? true : false)
                                        ]),
                                ])
                                ->from('md'),
                                Split::make([
                                    Section::make('Tema Undangan')
                                        ->collapsible()
                                        ->icon(Icons::BRUSH->value)
                                        ->iconSize(IconSize::Small)
                                        ->schema([
                                            TextInput::make('no_package_selected')
                                                ->hiddenLabel()
                                                ->disabled()
                                                ->default('Silahkan pilih paket undangan terlebih dahulu...')
                                                ->hidden(fn(Get $get) => !empty($get('selected_package_id'))),
                                            Select::make('selected_theme_id')
                                                ->required()
                                                ->placeholder('Pilih tema undangan')
                                                ->hiddenLabel()
                                                ->hidden(fn(Get $get) => empty($get('selected_package_id')))
                                                ->options(Theme::where('is_active', '=', true)->pluck('theme_name', 'id'))
                                                ->searchable()
                                                ->getSearchResultsUsing(fn (string $search): array => Theme::where('theme_name', 'like', "%{$search}%")->limit(50)->pluck('theme_name', 'id')->toArray())
                                        ]),
                                    Section::make('Lagu Undangan')
                                        ->collapsible()
                                        ->icon(Icons::MUSIC->value)
                                        ->iconSize(IconSize::Small)
                                        ->schema([
                                            TextInput::make('no_package_selected')
                                                ->hiddenLabel()
                                                ->disabled()
                                                ->default('Silahkan pilih paket undangan terlebih dahulu...')
                                                ->hidden(fn(Get $get) => !empty($get('selected_package_id'))),
                                            Select::make('selected_song_id')
                                                ->hiddenLabel()
                                                ->placeholder('Pilih lagu')
                                                ->options(Song::where('is_active', '=', true)->pluck('song_title', 'id'))
                                                ->live()
                                                ->required()
                                                ->searchable()
                                                ->hidden(fn(Get $get) => empty($get('selected_package_id')))
                                                ->suffixActions([
                                                    MediaAction::make('selected_song_id')
                                                        ->iconButton()
                                                        ->icon('heroicon-o-play')
                                                        ->modalHeading(fn() => Song::find($this->data['selected_song_id'])->song_title)
                                                        ->tooltip('Putar Lagu Terpilih')
                                                        ->media(fn() => !empty($this->data['selected_song_id']) ? url('storage/'.Song::find($this->data['selected_song_id'])->song_filename) : null)
                                                        ->disabled(fn() => empty($this->data['selected_song_id'])),
                                                ]),
                                            FileUpload::make('song_filename')
                                                ->label('Upload Lagu (.mp3)')
                                                ->acceptedFileTypes($acceptedAudioTypes)
                                                ->columnSpanFull()
                                                ->hidden(function(Get $get)
                                                    {
                                                        if (!empty($get('selected_package_id')))
                                                        {
                                                            try {
                                                                $check = Package::find($get('selected_package_id'))->package_name;
                                                                return Str::lower('platinum') == Str::lower($check) ? false: true;
                                                            } catch (\Throwable $th) {
                                                                dd($th);
                                                            }
                                                        }

                                                        return true;
                                                    }),
                                        ])
                                ])
                                ->from('md')
                            ]),
                        Tab::make('Design')
                            ->icon(Icons::BRUSH->value)
                            ->schema([
                                // ...
                            ]),
                        Tab::make('Guest')
                            ->icon(Icons::TWO_PEOPLE->value)
                            ->badge(5)
                            ->schema([
                                // ...
                            ]),
                        Tab::make('Greetings')
                            ->icon(Icons::CHAT->value)
                            ->badge(2)
                            ->schema([
                                // RadioDeck::make('selected_song_id')
                                //     ->options([
                                //         'ios' => 'iOS',
                                //         'android' => 'Android',
                                //         'web' => 'Web',
                                //         'windows' => 'Windows',
                                //         'mac' => 'Mac',
                                //         'linux' => 'Linux',
                                //     ])
                                //     ->padding('px-4 px-6 py-4 py-6')
                                //     ->extraCardsAttributes([ // Extra Attributes to add to the card HTML element
                                //         'class' => 'space-y-3.5 > * + *'
                                //     ])
                            ]),
                        ]),
            ])
            ->columns('full')
            ->statePath('data');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function openChooseSong()
    {
        $this->dispatch('open-modal', id:'test-modal');
    }

    public function openChooseTheme()
    {
        $this->dispatch('open-modal', id:'test-modal');
    }

    // public function getDataku()
    // {
    //     $songs = Song::where('is_active', true)->get();
    //     return $songs;
    // }

    public function chooseSong($id)
    {
        $selected = Song::find($id)->song_title;
        $this->dispatch('close-modal', id:'test-modal');
        $this->form->fill([
            'selected_song_id' => $selected,
        ]);
        // $this->set('selected_song_id', $selected);
    }

    public function chooseTestModal() 
    {
        $this->dispatch('close-modal', id:'test-modal');
    }
    

    public function getFormActions(): array
    {
        return 
        [
            getCustomCreateFormAction('Save', Icons::CHECK) /* this button will call create method below */, 
            Action::make('cancel')
                ->extraAttributes(['onclick' => new HtmlString("return confirm('Are you sure you want to save?')")])
            // getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->previousUrl ?? static::getResource()::getUrl()))
        ];
    }

    public function create()
    {
        try {
            $this->validate();
            dd($this->validate());
            $savedData = new Invitation();
            $savedData->fill([
                'event_name' => $this->data['event_name'],
                'slug' => $this->data['slug'],
                'selected_event_type_id' => $this->data['selected_event_type_id'],
                'selected_song_id' => $this->data['selected_song_id'],
                'selected_theme_id' => $this->data['selected_theme_id'],
                'selected_package_id' => $this->data['selected_package_id'],
                // 'is_active' => $this->data['is_active'],
                'created_by' => auth()->user()->username,
                'updated_by' => auth()->user()->username,
            ]);
            $savedData->saveOrFail();

            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->username;
        $data['updated_by'] = auth()->user()->username;
        return $data;
    }

    public function createInvitation()
    {
        dd('here');
    }

    // public function render(): View
    // {
    //     return view('filament.resources.digital-invitation.transaction.invitation-resource.pages.invitation-add'
    //     // , [
    //     //     'users' => User::query()->paginate($this->perPage),
    //     // ]
    // );
    // }

    protected static string $view = 'filament.resources.digital-invitation.transaction.invitation-resource.pages.invitation-add';
}
