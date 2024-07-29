<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Split;
use Filament\Support\Enums\IconSize;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\DigitalInvitation\Master\Song;
use App\Models\DigitalInvitation\Master\Theme;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\DigitalInvitation\Master\EventType;
use App\Models\DigitalInvitation\Setting\PackageFeature;
use App\Models\DigitalInvitation\Transaction\Invitation;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource;

class InvitationAdd extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static string $resource = InvitationResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('General')
                            ->icon(Icons::GEAR->value)
                            ->iconPosition(IconPosition::After)
                            ->schema([
                                Split::make([
                                    Section::make('Event Settings')
                                        ->schema([
                                            TextInput::make('event_name')
                                                ->required()
                                                ->live(onBlur:true)
                                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                                ->hiddenLabel()
                                                ->placeholder('Event Name'),
                                            TextInput::make('slug')
                                                ->required()
                                                ->hiddenLabel()
                                                ->live()
                                                ->placeholder('Slug')
                                                ->disabled(fn (Get $get): bool => !filled($get('event_name')))
                                                ->helperText(fn (Get $get) => 'https://arsakarta.com/'.$get('slug'))
                                                ->url(),
                                            Select::make('selected_event_type_id')
                                                ->required()
                                                ->placeholder('Choose Event Type')
                                                ->hiddenLabel()
                                                ->options(EventType::where('is_active', '=', true)->pluck('event_type', 'id'))
                                                ->live()
                                                // ->dehydrated(false)
                                                ->afterStateUpdated(function (Set $set) {
                                                    $set('selected_package_id', null);
                                                })
                                                ->searchable()
                                                ->getSearchResultsUsing(fn (string $search): array => EventType::where('event_type', 'like', "%{$search}%")->limit(50)->pluck('event_type', 'id')->toArray()),
                                            Toggle::make('is_active')
                                                ->default(true)
                                                ->inline()
                                                ->label('Active')
                                                ->onColor('success')
                                                ->offColor('danger')
                                                ->onIcon(Icons::V_MARK->value)
                                                ->offIcon(Icons::X_MARK->value)
                                        ])
                                        ->collapsible()
                                        ->icon(Icons::GEAR->value)
                                        ->iconSize(IconSize::Small),
                                    Section::make('Media Settings')
                                        ->schema([
                                            Select::make('selected_song_id')
                                                ->required()
                                                ->placeholder('Choose Song')
                                                ->hiddenLabel()
                                                ->options(Song::where('is_active', '=', true)->pluck('song_title', 'id'))
                                                ->searchable()
                                                ->getSearchResultsUsing(fn (string $search): array => Song::where('song_title', 'like', "%{$search}%")->limit(50)->pluck('song_title', 'id')->toArray()),
                                            Select::make('selected_theme_id')
                                                ->required()
                                                ->placeholder('Choose Theme')
                                                ->hiddenLabel()
                                                ->options(Theme::where('is_active', '=', true)->pluck('theme_name', 'id'))
                                                ->searchable()
                                                ->getSearchResultsUsing(fn (string $search): array => Theme::where('theme_name', 'like', "%{$search}%")->limit(50)->pluck('theme_name', 'id')->toArray()),
                                            Select::make('selected_package_id')
                                                // ->dehydrated()
                                                // ->disabled(fn (Get $get): bool => !filled($get('event_type_id')))
                                                ->required()
                                                ->placeholder('Choose Package')
                                                ->hiddenLabel()
                                                ->searchable()
                                                ->options(function (Get $get, Set $set) { 
                                                    if (! empty($get('selected_event_type_id')))
                                                    {
                                                        return PackageFeature::where('event_type_id', $get('selected_event_type_id'))->get()->pluck('package.package_name', 'package.id');
                                                    }
                                                    return null;
                                                })
                                        ])
                                        ->collapsible()
                                        ->icon(Icons::MUSIC->value)
                                        ->iconSize(IconSize::Small)
                                ])
                                ->from('md')
                            ]),
                        Tab::make('Design')
                            ->icon(Icons::BRUSH->value)
                            ->iconPosition(IconPosition::After)
                            ->schema([
                                // ...
                            ]),
                        Tab::make('Guest')
                            ->icon(Icons::TWO_PEOPLE->value)
                            ->iconPosition(IconPosition::After)
                            ->badge(5)
                            ->schema([
                                // ...
                            ]),
                        Tab::make('Greetings')
                            ->icon(Icons::CHAT->value)
                            ->iconPosition(IconPosition::After)
                            ->badge(2)
                            ->schema([
                                // ...
                            ]),
                    ])
            ])
            ->statePath('data');
    }

    public function mount(): void
    {
        $this->form->fill();
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
            $savedData = new Invitation();
            $savedData->fill([
                'event_name' => $this->data['event_name'],
                'slug' => $this->data['slug'],
                'selected_event_type_id' => $this->data['selected_event_type_id'],
                'selected_song_id' => $this->data['selected_song_id'],
                'selected_theme_id' => $this->data['selected_theme_id'],
                'selected_package_id' => $this->data['selected_package_id'],
                'is_active' => $this->data['is_active'],
                'created_by' => auth()->user()->username,
                'updated_by' => auth()->user()->username,
            ]);
            $savedData->saveOrFail();
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

    protected static string $view = 'filament.resources.digital-invitation.transaction.invitation-resource.pages.invitation-add';
}
