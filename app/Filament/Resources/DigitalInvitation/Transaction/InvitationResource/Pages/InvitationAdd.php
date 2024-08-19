<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\MimeType;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Facades\Log;
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
use Closure;
use Filament\Forms\Components\Component;

use function Laravel\Prompts\alert;

class InvitationAdd extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    // public $dataku = 'test';
    // public Set $set;
    // public Get $get;

    protected static string $resource = InvitationResource::class;

    protected $listeners = [
        'payment-success'       => 'paymentSuccess',
        'payment-closed'       => 'paymentClosed'
    ];

    public function messages(): array
    {
        return [
            'data.selected_event_type_id.required' => 'Tipe undangan harus diisi.',
            'data.selected_theme_id.required' => 'Tema undangan harus diisi.',
            'data.selected_song_id.required' => 'Lagu undangan harus diisi.',
            'data.event_name.required' => 'Nama undangan harus diisi.',
            'data.slug.required' => 'Slug harus diisi.',
            'data.slug.unique' => 'Slug telah digunakan.',
        ];
    }

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
                                                ->live()
                                                ->required()
                                                ->searchable()
                                                ->label('Jenis Undangan')
                                                ->placeholder('Pilih Tipe Undangan')
                                                ->options(EventType::where('is_active', '=', true)->pluck('event_type', 'id'))
                                                ->disabled(fn () => !empty($this->data['id']))
                                                ->afterStateUpdated(function (Set $set) {
                                                    $set('selected_package_id', null);
                                                })
                                                ->getSearchResultsUsing(fn (string $search): array => EventType::where('event_type', 'like', "%{$search}%")->limit(50)->pluck('event_type', 'id')->toArray()),
                                            TextInput::make('event_name')
                                                ->required()
                                                ->live(onBlur:true)
                                                ->label('Nama Undangan')
                                                ->placeholder('Nama Undangan')
                                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                            TextInput::make('slug')
                                                ->live()
                                                ->required()
                                                ->label('Link Undangan')
                                                ->placeholder('Slug')
                                                ->disabled(fn (Get $get): bool => !filled($get('event_name')))
                                                ->helperText(fn (Get $get) => 'https://arsakarta.com/'.$get('slug'))
                                                ->rule(function (Get $get, Component $component)
                                                    {
                                                        return static function (string $attr, $value, Closure $fail) use ($get, $component)
                                                        {
                                                            $existingSlug = Invitation::where('slug', $value)
                                                                            ->where('id', '<>', $get('id'))
                                                                            ->first();

                                                            if ($existingSlug)
                                                            {
                                                                $fail("Slug sudah digunakan.");
                                                            }
                                                        };
                                                    }
                                                )
                                                ->afterStateUpdated(function ($livewire) {
                                                    $livewire->validateOnly('data.slug');
                                                })
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
                                                ->placeholder('Pilih tipe undangan terlebih dahulu...')
                                                ->hidden(fn(Get $get) => !empty($get('selected_event_type_id'))),
                                            Radio::make('selected_package_id')
                                                ->hiddenLabel()
                                                ->live()
                                                ->disableOptionWhen(function (string $value)
                                                {
                                                    if (!empty($this->data['id']))
                                                    {
                                                        $currentInvitation = Invitation::find($this->data['id']);
                                                        $currentPackage = PackageFeature::where('event_type_id', $currentInvitation->selected_event_type_id)
                                                                            ->where('package_id', $currentInvitation->selected_package_id)
                                                                            ->first();
                                                        $selectedPackage = PackageFeature::where('event_type_id', $this->data['selected_event_type_id'])
                                                                            ->where('package_id', $value)
                                                                            ->first();

                                                        if ($currentPackage->price > $selectedPackage->price)
                                                        {
                                                            return true;
                                                        }
                                                        else
                                                        {
                                                            return false;
                                                        }
                                                    }
                                                })
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
                                                })
                                                ->afterStateUpdated(function (Set $set) { $this->paketDipilih($set); }
                                                ),
                                        ])
                                        ->headerActions([
                                            FormAction::make('upgrade')
                                                ->label('Info Paket')
                                                ->disabled(fn(Get $get) => empty($get('selected_event_type_id')))
                                                ->link()
                                                ->icon(Icons::INFO->value)
                                                ->action('openInfoPaketModal')
                                        ])
                                        ->footerActionsAlignment(Alignment::End)
                                        ->footerActions([
                                            FormAction::make('choose')
                                                ->label('Pilih Paket')
                                                ->icon(Icons::CHECK->value)
                                                ->action('pilihPaket')
                                                ->disabled(function (Set $set) 
                                                    {
                                                        return $this->disabledPilihUndangan($set);
                                                    }
                                                )
                                        ]),
                                ])
                                ->from('md'),
                            ]),
                        Tab::make('Design')
                            ->icon(Icons::BRUSH->value)
                            ->schema([
                                
                                Split::make([
                                    Section::make('Tema Undangan')
                                        ->collapsible()
                                        ->icon(Icons::BRUSH->value)
                                        ->iconSize(IconSize::Small)
                                        ->schema([
                                            TextInput::make('no_package_selected')
                                                ->hiddenLabel()
                                                ->disabled()
                                                ->placeholder('Pilih paket undangan terlebih dahulu...')
                                                ->hidden(fn(Get $get) => !empty($get('is_paid'))),
                                            Select::make('selected_theme_id')
                                                // ->required()
                                                ->placeholder('Pilih tema undangan')
                                                ->hiddenLabel()
                                                ->hidden(fn(Get $get) => empty($get('is_paid')))
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
                                                ->placeholder('Pilih paket undangan terlebih dahulu...')
                                                ->hidden(fn(Get $get) => !empty($this->data['is_paid'])),
                                            Select::make('selected_song_id')
                                                ->hiddenLabel()
                                                ->placeholder('Pilih lagu')
                                                ->options(Song::where('is_active', '=', true)->pluck('song_title', 'id'))
                                                ->live()
                                                // ->required()
                                                ->searchable()
                                                ->hidden(fn(Get $get) => empty($this->data['is_paid']))
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
                                                        if (!empty($get('is_paid')))
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

    public function mount(Invitation $record): void
    {
        $this->form->fill($record->toArray());
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
            // getCustomCreateFormAction('Save', Icons::CHECK) /* this button will call create method below */,
            FormAction::make('create')
                ->label('Save')
                ->submit('create')
                ->disabled(function () { return $this->disabledButtonSave() ? true : false; })
                ->keyBindings(['mod+s'])
                ->icon(Icons::CHECK->value)
                ->iconSize(IconSize::Small),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->getResource()::getUrl('index')))
        ];
    }

    public function create()
    {
        try 
        {
            $this->validateInvitationData();
            $this->validate();

            $this->data['content'] = null;

            // dd($this->data);

            if (!empty($this->data['id']) && $this->data['id'])
            {
                $updatedData = Invitation::find($this->data['id']);
                $updatedData['event_name']              = $this->data['event_name'];
                $updatedData['slug']                    = $this->data['slug'];
                $updatedData['selected_event_type_id']  = $this->data['selected_event_type_id'];
                $updatedData['selected_song_id']        = $this->data['selected_song_id'];
                $updatedData['selected_theme_id']       = $this->data['selected_theme_id'];
                $updatedData['selected_package_id']     = $this->data['selected_package_id'];
                $updatedData['is_paid']                 = $this->data['is_paid'];
                $updatedData['is_free']                 = $this->data['is_free'];
                $updatedData['midtrans_transaction_id'] = $this->data['midtrans_transaction_id'];
                $updatedData['content']                 = $this->data['content'];
                $updatedData['user_id']                 = auth()->user()->id;
                $updatedData['updated_by']              = auth()->user()->username;
                $updatedData->save();
            }
            else 
            {
                // dd(auth()->user()->username);
                $savedData = new Invitation();
                $savedData->fill([
                    'event_name'                => $this->data['event_name'],
                    'slug'                      => $this->data['slug'],
                    'selected_event_type_id'    => $this->data['selected_event_type_id'],
                    'selected_song_id'          => $this->data['selected_song_id'],
                    'selected_theme_id'         => $this->data['selected_theme_id'],
                    'selected_package_id'       => $this->data['selected_package_id'],
                    'is_paid'                   => $this->data['is_paid'],
                    'is_free'                   => $this->data['is_free'],
                    'midtrans_transaction_id'   => $this->data['midtrans_transaction_id'],
                    'content'                   => $this->data['content'],
                    'user_id'                   => auth()->user()->id,
                    'created_by'                => auth()->user()->username,
                    'updated_by'                => auth()->user()->username,
                ]);
                $savedData->saveOrFail();

                Notification::make()
                    ->title('Saved successfully')
                    ->success()
                    ->send();
            }

            redirect($this->getResource()::getUrl('index'));
        } 
        catch (\Throwable $th) 
        {
            // dd($th);
            $this->validate();
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->username;
        $data['updated_by'] = auth()->user()->username;
        return $data;
    }

    // validasi
    public function validateInvitationData()
    {
        // dd($this->data);
        $message = null;
        $body = null;

        if (empty($this->data['midtrans_transaction_id']))
        {
            $message = 'Tombol Pilih Paket belum diklik.';
            $body = 'Setelah melakukan pemilihan paket, harap tekan tombol Pilih Paket.';
            return;
        }

        // dd(!empty($message));

        if (!empty($message))
            Notification::make()
            ->title($message)
            ->body(!empty($body) ? $body : '')
            ->danger()
            ->send();
    }

    // start of modal info paket 
    public function openInfoPaketModal()
    {
        $this->dispatch('open-modal', id:'modal-info-paket');
    }

    public function getDataPaket()
    {
        try 
        {
            if (!empty($this->data['selected_event_type_id'])) 
            {
                return PackageFeature::where('event_type_id', $this->data['selected_event_type_id'])->get();
            }

            return [];
        } 
        catch (\Throwable $th) 
        {
            Log::error($th);
        }
    }

    public function selectFromModalInfoPaket($id)
    {
        try 
        {
            $this->dispatch('close-modal', id:'modal-info-paket');
            $this->data['selected_package_id'] = $id;

            Notification::make()
                ->title('Paket berhasil dipilih.')
                ->success()
                ->send();
        } 
        catch (\Throwable $th) 
        {
            Log::error($th);
        }
    }

    public function isSameCurrentAndSelectedPackage($checkIsPaid)
    {
        $isSame = false;
        if (!empty($this->data['id']))
        {
            $currentInvitation = Invitation::find($this->data['id']);
            $currentPackage = PackageFeature::where('event_type_id', $currentInvitation->selected_event_type_id)
                                ->where('package_id', $currentInvitation->selected_package_id)
                                ->first();
            $selectedPackage = PackageFeature::where('event_type_id', $this->data['selected_event_type_id'])
                                ->where('package_id', $this->data['selected_package_id'])
                                ->first();

            if (!$checkIsPaid && $selectedPackage->id == $currentPackage->id && $selectedPackage->price >= $currentPackage->price)
                $isSame = true; 
            else if ($checkIsPaid && $selectedPackage->id != $currentPackage->id && !$this->data['is_paid'])
            {
                $isSame = true; 
            }
        }

        return $isSame;
    }

    public function disabledButtonSave()
    {
        $buttonDisabled = false;

        $buttonDisabled = $this->isSameCurrentAndSelectedPackage(true /* $checkIsPaid */);
        $buttonDisabled = empty($this->data['selected_package_id']) ? true : false;
        
        if (!empty($this->data['is_free']) && !empty($this->data['is_paid']))
            $buttonDisabled = !$this->data['is_free'] && !$this->data['is_paid'] ? true : false;

        $buttonDisabled = empty($this->data['midtrans_transaction_id']) ? true : false;

        return $buttonDisabled;
    }

    public function disabledPilihUndangan($set)
    {
        $buttonDisabled = false;

        if (!empty($this->data['is_free']) && $this->data['is_free'])
            $buttonDisabled = true;

        $buttonDisabled = $this->isSameCurrentAndSelectedPackage(false /* $checkIsPaid */);
        $buttonDisabled = empty($this->data['selected_package_id']) ? true : false;
        $buttonDisabled = !empty($this->data['midtrans_transaction_id']) ? true : false;

        return $buttonDisabled;

        // if (!empty($this->data['id']))
        // {
        //     $currentInvitation = Invitation::find($this->data['id']);
        //     $currentPackage = PackageFeature::where('event_type_id', $currentInvitation->selected_event_type_id)
        //                         ->where('package_id', $currentInvitation->selected_package_id)
        //                         ->first();
        //     $selectedPackage = PackageFeature::where('event_type_id', $this->data['selected_event_type_id'])
        //                         ->where('package_id', $this->data['selected_package_id'])
        //                         ->first();

        //     if ($selectedPackage->id != $currentPackage->id
        //         && $selectedPackage->price > $currentPackage->price)
        //     {
        //         return false;
        //     }
        //     else
        //     {
        //         // Notification::make()
        //         //     ->title('Tidak dapat melakukan downgrade paket.')
        //         //     ->warning()
        //         //     ->send();

        //         $set('selected_package_id', $currentInvitation->selected_package_id);
        //         $set('selected_theme_id', $currentInvitation->selected_theme_id);
        //         $set('selected_song_id', $currentInvitation->selected_song_id);
        //         $set('is_paid', $currentInvitation->is_paid);
        //         return true;
        //     }
        // }
        // else if (!empty($this->data['is_paid']))
        // {
        //     return $this->data['is_paid'] ? true : false;
        // }
        // else if (!empty($this->data['is_free']))
        // {
        //     return $this->data['is_free'] ? true : false;
        // }
        // else
        // {
        //     if (!empty($this->data['selected_package_id']))
        //     {
        //         $selectedPackage = $this->getPackgaeById($this->data['selected_package_id']);
        //         if (str_contains(Str::lower($selectedPackage['package_name']), 'free'))
        //         {
        //             $this->data['is_paid'] = false; 
        //             $this->data['is_free'] = true; 
        //             $this->data['midtrans_transaction_id'] = null;
        //             return false;
        //         }
        //     }
        //     else
        //         return true;
        // }
        // return true;
    }

    public function paketDipilih($set)
    {
        $selectedPackage = null;
        $set('is_paid', false);
        $set('is_free', false);
        $set('selected_theme_id', null);
        $set('selected_song_id', null);
        $set('midtrans_transaction_id', null);

        /* cek paket yang dipilih */
        if (!empty($this->data['selected_package_id']))
        {
            $selectedPackage = $this->getPackgaeById($this->data['selected_package_id']);
            if (str_contains(Str::lower($selectedPackage['package_name']), 'free'))
            {
                $set('is_free', true);
            }
        }
    }

    public function pilihPaket() 
    {
        try 
        {
            if (!empty($this->data['selected_package_id'])) 
            {
                $selectedPackage = $this->getPackgaeById($this->data['selected_package_id']);
                if (str_contains(Str::lower($selectedPackage['package_name']), 'free'))
                {
                    $this->data['is_paid'] = false; 
                    $this->data['is_free'] = true; 
                    $this->data['midtrans_transaction_id'] = '-';
                }
                else 
                {
                    $packageFeature = PackageFeature::where('event_type_id', $this->data['selected_event_type_id'])
                    ->where('package_id', $this->data['selected_package_id'])
                    ->first();

                    // Set your Merchant Server Key
                    \Midtrans\Config::$serverKey = 'SB-Mid-server-C6C-9aMAcKG6-_C5hfX-dq5d'; //'YOUR_SERVER_KEY';
                    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                    \Midtrans\Config::$isProduction = false;
                    // Set sanitization on (default)
                    \Midtrans\Config::$isSanitized = true;
                    // Set 3DS transaction for credit card to true
                    \Midtrans\Config::$is3ds = true;

                    $params = array(
                        'transaction_details' => array(
                            'order_id'      => rand(),
                            'gross_amount'  => $packageFeature->price,
                        ),
                        'item_details' => array(
                            array(
                                'id' => $packageFeature->package->id,
                                'quantity' => 1,
                                'price' =>$packageFeature->price,
                                'name' => $packageFeature->package->package_name
                            )
                        ),
                        'customer_details' => array(
                            'first_name' => auth()->user()->name,
                            'email' => auth()->user()->email,
                            'username' => auth()->user()->username,
                        )
                    );

                    $snapToken = \Midtrans\Snap::getSnapToken($params);
                    $this->dispatch('snap-pay', title: 'tokenizer', token: $snapToken);
                }
            }
        } 
        catch (\Throwable $th) 
        {
            dd($th);
        } 
    }

    public function getPackgaeById($id)
    {
        try 
        {
            return Package::find($this->data['selected_package_id']);
        } 
        catch (\Throwable $th) 
        {
            Log::error($th);
        }

    }

    public function paymentSuccess($order_id)
    {
        $this->data['midtrans_transaction_id'] = $order_id;
        $this->data['is_paid'] = true;

        Notification::make()
            ->title('Pembayaran berhasil.')
            ->success()
            ->send();

        // dd($this->data);
    }

    public function paymentClosed()
    {
        $selectedPackage = $this->getPackgaeById($this->data['selected_package_id']);

        if (str_contains(Str::lower($selectedPackage['package_name']), 'free'))
        {
            $this->data['is_paid'] = true; 
        }
        else 
        {
            $this->data['is_paid'] = false; 
        }
    }
    // end of modal info paket

    protected static string $view = 'filament.resources.digital-invitation.transaction.invitation-resource.pages.invitation-add';
}
