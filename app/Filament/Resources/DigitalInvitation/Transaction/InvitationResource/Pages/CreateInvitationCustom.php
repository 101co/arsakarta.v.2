<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

use Carbon\Carbon;
use Midtrans\Snap;
use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Split;
use Filament\Support\Enums\IconSize;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;

use function PHPUnit\Framework\isNull;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Actions\Action;
use App\Models\DigitalInvitation\Master\Theme;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\DigitalInvitation\Master\Package;
use App\Models\DigitalInvitation\Master\EventCategory;
use App\Models\DigitalInvitation\Transaction\Invitation;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource;
use App\Models\DigitalInvitation\Transaction\InvitationPayment;

class CreateInvitationCustom extends Page implements HasForms {
    use InteractsWithForms;

    public $layouts = [];
    public $theme = null;
    public $currentInvitationId = null;
 
    public ?array $data = [];
    public $newPaymentId = null;
    public $isMoreThanEditingDay = false;
    public $isBackToList = true;
    protected static string $resource = InvitationResource::class;
    protected static string $view = 'filament.resources.digital-invitation.transaction.invitation-resource.pages.create-invitation-custom';
    // protected $listeners = [
    //     'payment-success'   => 'paymentSuccess',
    //     'payment-closed'    => 'paymentClosed'
    // ];

    public function getTitle(): string | Htmlable {
        return __('Undanganmu');
    }

    public function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    public function mount(Invitation $record): void {
        if ($record) {
            $this->theme = Theme::where('id', '=', $record->theme_id)->first();
        }

        $this->form->fill($record->toArray());
        $this->checkDataIsMoreThanEditingDay();
        $this->isBackToList;
    }

    public function getFormActions(): array {
        return [
            Action::make('create')
                ->label('Save')
                ->submit('create')
                ->disabled(function () { 
                    $buttonDisabled = false;

                    if (empty($this->data['event_category_id']))
                        $buttonDisabled = true;

                    if (empty($this->data['package_id']))
                        $buttonDisabled = true;

                    if (empty($this->data['id'])) {
                        $buttonDisabled = !$this->data['is_paid'] ? true:false;
                    }
                    else {
                        $currentInvitation = Invitation::find($this->data['id']);
                        $currentPackage = Package::where('id', $currentInvitation->package_id)->first();
                        $selectedPackage = Package::where('id', $this->data['package_id'])->first();

                        if ($currentPackage->id == $selectedPackage->id)
                            $this->data['is_paid'] = $currentInvitation->is_paid;

                        $buttonDisabled = !$this->data['is_paid'] ? true:false;
                    }

                    return $buttonDisabled;
                })
                ->keyBindings(['mod+s'])
                ->icon(Icons::CHECK->value)
                ->iconSize(IconSize::Small),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->getResource()::getUrl('index')))
        ];
    }

    private function getBlocks() {
        if (!$this->theme)
            return [];

        
        foreach ($this->theme['layouts'] as $layout ) {
            $getLayout = getBlockBuilder($layout, $this->theme->eventCategory['name']);

            if ($getLayout) {
                array_push($this->layouts, $getLayout);
            }
        }

        $blocks = array_map(function ($layout) {
            $block = Block::make($layout['type'])
                ->label($layout['label'])
                ->schema(
                    collect($layout['fields'])->map(function ($field) {
                        switch ($field['type']) {
                            case 'text':
                                return TextInput::make($field['name'])
                                            ->label($field['label'])
                                            ->default($field['default'])
                                            ->required($field['required']);
                            case 'textarea':
                                return TextArea::make($field['name'])
                                            ->label($field['label']);
                            default:
                                return null;
                        }
                    })->filter()->toArray()
                )
                ->maxItems(1);
            return $block;
        }, collect($this->layouts)->unique()->values()->all());

        return collect($blocks)->unique()->values()->all();
    }
    
    public function form(Form $form): Form {
        return $form
            ->schema([
                Tabs::make()
                    ->tabs([
                    Tab::make('General')
                        ->schema([
                            Split::make([
                                Section::make([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(100)
                                        ->live(onBlur:true)
                                        ->label('Invitation Name')
                                        ->disabled(fn () => $this->isMoreThanEditingDay)
                                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                    TextInput::make('slug')
                                        ->live()
                                        ->required()
                                        ->maxLength(255)
                                        ->label('URL (Slug)')
                                        ->disabled(fn (Get $get): bool => !filled($get('name')) || $this->isMoreThanEditingDay)
                                        ->helperText(fn (Get $get) => 'https://arsakarta.com/'.$get('slug'))
                                        ->unique(ignoreRecord: true)
                                        // ->rule(function (Get $get, Component $component) {
                                        //     return static function (string $attr, $value, Closure $fail) use ($get, $component) {
                                        //         $existingSlug = Invitation::where('slug', $value)
                                        //                         ->where('id', '<>', $get('id'))
                                        //                         ->first();

                                        //         if ($existingSlug) {
                                        //             $fail("URL (Slug) already taken.");
                                        //         }
                                        //     };
                                        // })
                                        ->afterStateUpdated(function ($livewire) {
                                            $livewire->validateOnly('data.slug');
                                        }),
                                    Select::make('event_category_id')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->live()
                                        ->disabled(fn () => $this->isMoreThanEditingDay)
                                        ->label('Event Category')
                                        ->options(EventCategory::where('is_active', true)->pluck('name', 'id')),
                                ])
                                ->iconSize(IconSize::Small)
                                ->heading('General Setting')
                                ->icon(Icons::GEAR->value),
                                Section::make([
                                    Hidden::make('is_paid'),
                                    Hidden::make('order_id'),
                                    Radio::make('package_id')
                                        ->live()
                                        ->required()
                                        ->label('Package')
                                        ->disableOptionWhen(function (string $value) {
                                            if (!empty($this->data['id'])) {
                                                $currentInvitation = Invitation::find($this->data['id']);
                                                $currentPackage = Package::where('id', $currentInvitation->package_id)->first();
                                                $selectedPackage = Package::where('id', $value)->first();

                                                if ($currentPackage->price > $selectedPackage->price)
                                                    return true;
                                                else if (!isNull($this->newPaymentId))
                                                    return true;
                                                else
                                                    return false;
                                            }
                                        })
                                        ->options(fn(Get $get) => Package::where('is_active', true)->get()->pluck('name', 'id'))
                                        ->descriptions(function(Get $get) {
                                            $price = Package::where('is_active', true)->get()->pluck('price', 'id');
                                            $formatedPrice = [];
    
                                            foreach ($price as $item => $entry)
                                            {
                                                $price[$item] = 'IDR '. number_format($price[$item], 0);
                                            }
                                            return $price;
                                        })
                                        ->disabled(function () {
                                            fn () => $this->isMoreThanEditingDay;
                                        })
                                        ->afterStateUpdated(function() {
                                            $this->data['is_paid'] = false;

                                            if (!empty($this->data['id'])) {
                                                $currentInvitation = Invitation::find($this->data['id']);
                                                $currentPackage = Package::where('id', $currentInvitation->package_id)->first();
                                                $selectedPackage = Package::where('id', $this->data['package_id'])->first();

                                                if ($currentPackage->id == $selectedPackage->id)
                                                    $this->data['is_paid'] = $currentInvitation->is_paid;
                                            }                                            
                                        })
                                ])
                                ->iconSize(IconSize::Small)
                                ->heading('Choose Package')
                                ->icon(Icons::TICKET->value)
                                ->headerActions([
                                    Action::make('upgrade')
                                        ->label('Info Paket')
                                        ->link()
                                        ->icon(Icons::INFO->value)
                                        ->action('openModalPackage')
                                ])
                                ->footerActions([
                                    Action::make('choose')
                                        ->label('Choose Package')
                                        ->icon(Icons::CHECK->value)
                                        ->action('choosePackage')
                                        ->disabled(function (Set $set, Get $get) {
                                            $buttonDisabled = false;

                                            if (empty($this->data['event_category_id']))
                                                $buttonDisabled = true;

                                            if (empty($this->data['package_id']))
                                                $buttonDisabled = true;

                                            if ($this->data['is_paid'])
                                                $buttonDisabled = true;

                                            if (!is_null($this->data['order_id']))
                                                $buttonDisabled = true;

                                            if (!empty($this->data['id'])) {
                                                $currentInvitation = Invitation::find($this->data['id']);
                                                $currentPackage = Package::where('id', $currentInvitation->package_id)->first();
                                                $selectedPackage = Package::where('id', $this->data['package_id'])->first();
                        
                                                $buttonDisabled = $this->data['is_paid'] ? true:false;
                                            }

                                            return $buttonDisabled;
                                        })
                                ])
                            ])
                            ->from('md'),
                        ]),
                    Tab::make('Design')
                        ->schema([
                            Split::make([
                                Section::make([
                                    Select::make('theme_id')
                                        // ->required()
                                        ->searchable()
                                        ->preload()
                                        ->reactive()
                                        ->disabled(fn () => $this->isMoreThanEditingDay)
                                        ->label('Theme')
                                        ->options(function(Get $get) {
                                            return Theme::where('is_active', true)
                                                            ->where('event_category_id', '=', $get('event_category_id'))
                                                            ->where('package_id', '=', $get('package_id'))
                                                            ->pluck('theme_name', 'id');
                                        })
                                        ->afterStateUpdated(function ($state, Set $set) {
                                            $this->theme = Theme::where('id', '=', $state)->first();
                                            $set('layouts', [
                                                Str::uuid()->toString() => [
                                                    'type'  => 'cover',
                                                    'data'  => [
                                                        'cover_title'           => 'Hello 1',
                                                        'cover_couple_name'     => 'hello 2',
                                                        'cover_button_title'    => 'buka'
                                                    ]
                                                ]
                                            ]);
                                        }),
                                ]),
                                Section::make([
                                    Builder::make('layouts')
                                        ->blocks(fn() => $this->getBlocks())
                                        ->hiddenLabel(true)
                                        ->collapsed()
                                        ->collapsible()
                                        ->blockNumbers(false)
                                        ->blockIcons()
                                        ->deleteAction(
                                            fn (Action $action) => $action->requiresConfirmation(),
                                        )
                                        ->addActionLabel('Add Invitation Layout')
                                ])
                                ->iconSize(IconSize::Small)
                                ->heading('Invitation Design')
                                ->icon(Icons::BRUSH->value)
                                ->headerActions([
                                    Action::make('choose-theme')
                                        ->label('Pilih Tema')
                                        ->link()
                                        ->action('bwoTest')
                                        ->icon(Icons::GENERAL->value)
                                ]),
                            ])
                            ->from('md')
                        ])
                ])
            ])
            ->columns('full')
            ->statePath('data');
    }

    public function openModalPackage() {
        $this->dispatch('open-modal', id:'modal-package');
    }

    function getPackageList() {
        return Package::where('is_active', true)->get();
    }

    function choosePackage() {
        try {
            $this->isBackToList = false;

            $isTrialPackage = Package::where('is_trial', true)
                        ->where('is_active', true)
                        ->where('id', '=', $this->data['package_id'])
                        ->first();
            
            if ($isTrialPackage) {
                $this->data['is_paid'] = true;
                $this->create();
                redirect($this->getResource()::getUrl('edit', ['record' => $this->currentInvitationId]));
            }
            else {
                $package = Package::where('is_active', true)
                            ->where('id', '=', $this->data['package_id'])
                            ->first();

                \Midtrans\Config::$serverKey = 'SB-Mid-server-C6C-9aMAcKG6-_C5hfX-dq5d' /*env('MIDTRANS_SERVER_KEY')*/;
                \Midtrans\Config::$isProduction = false; // Ubah ke true untuk production
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;

                $params = array(
                    'transaction_details' => array(
                        'order_id'      => rand(),
                        'gross_amount'  => $package->price,
                    ),
                    'item_details' => array(
                        array(
                            'id' => $package->id,
                            'quantity' => 1,
                            'price' =>$package->price,
                            'name' => $package->name
                        )
                    ),
                    'customer_details' => array(
                        'first_name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'username' => auth()->user()->username,
                    )
                );

                try {
                    $snapToken = Snap::getSnapToken($params);
                    $this->dispatch('snap-pay', title: 'tokenizer', token: $snapToken);
                } catch (\Exception $e) {
                    Log::error('Error Payment Load', $e);
                    Notification::make()
                        ->title('Payment not loaded.')
                        ->danger()
                        ->send();
                }
            }

            // dd($this->data);
        } catch (\Throwable $th) {
            Log::error('Error Choose Package', $th);
            Notification::make()
                ->title('Choose package has been failed.')
                ->danger()
                ->send();
        }
    }    

    #[On('payment-success')]
    public function paymentSuccess($order_id) {
        $this->newPaymentId = $order_id;
        $this->data['order_id'] = $this->newPaymentId;
        $this->data['is_paid'] = true;
        $this->create();
        redirect($this->getResource()::getUrl('edit', ['record' => $this->currentInvitationId]));

        Notification::make()
            ->title('Payment success.')
            ->success()
            ->send();
    }

    #[On('payment-closed')]
    public function paymentClosed() {
        $this->newPaymentId = null;

        Notification::make()
            ->title('Payment has been canceled.')
            ->warning()
            ->send();
    }

    function checkDataIsMoreThanEditingDay() {
        try {
            if (isset($this->data['created_at'])) {
                $editingDay = Package::where('id', '=', $this->data['package_id'])->pluck('editing_days')->firstOrFail();
                $createdDate = Carbon::parse($this->data['created_at']);
                $currentDate = Carbon::now();
                $this->isMoreThanEditingDay = $createdDate->diffInDays($currentDate) > $editingDay ? true:false;
            }
        } catch (\Throwable $th) {
            Log::error('checkDataIsMoreThanEditingDay', $th->getMessage());
            Notification::make()
                ->title('Something went wrong')
                ->danger()
                ->send();
        }
    }

    public function create() {
        try {
            $this->validate();

            // create / update data invitation
            $invitation = new Invitation();
            if (!empty($this->data['id']) && $this->data['id']) {
                $invitation = Invitation::find($this->data['id']);
                $invitation['name']                = $this->data['name'];
                $invitation['slug']                = $this->data['slug'];
                $invitation['event_category_id']   = $this->data['event_category_id'];
                $invitation['package_id']          = $this->data['package_id'];
                $invitation['theme_id']            = $this->data['theme_id'];
                $invitation['layouts']             = $this->data['layouts'];
                $invitation['user_id']             = $this->data['user_id'];
                $invitation['is_paid']             = $this->data['is_paid'];
                $invitation['updated_by']          = auth()->user()->username;
                $invitation['order_id'] = $this->data['order_id'];
                $invitation->save();
                $this->currentInvitationId = $invitation['id'];
            }
            else {
                $invitation = new Invitation();
                $invitation->fill([
                    'name'                  => $this->data['name'],
                    'slug'                  => $this->data['slug'],
                    'event_category_id'     => $this->data['event_category_id'],
                    'package_id'            => $this->data['package_id'],
                    'theme_id'              => $this->data['theme_id'],
                    'layouts'               => $this->data['layouts'] ? $this->data['layouts'] : null,
                    'user_id'               => auth()->user()->id,
                    'is_paid'               => $this->data['is_paid'],
                    'is_active'             => true,
                    'created_by'            => auth()->user()->username,
                    'updated_by'            => auth()->user()->username,
                    'order_id'              => $this->data['order_id']
                ]);
                $invitation->saveOrFail();
                $this->currentInvitationId = $invitation['id'];
            }

            // cmencatat invitation payment
            if ($invitation) {
                $invitationPayment = InvitationPayment::where('invitation_id', '=', $invitation['id'])
                                        ->where('order_id', '=', $invitation['order_id'])
                                        ->first();
                
                if (!$invitationPayment) {
                    $invitationPayment = new InvitationPayment();
                    $invitationPayment->fill([
                        'invitation_id'         => $invitation['id'],
                        'package_id'            => $invitation['package_id'],
                        'order_id'              => $invitation['order_id'],
                        'is_paid'               => $invitation['is_paid'],
                        'is_active'             => true,
                        'created_by'            => auth()->user()->username,
                        'updated_by'            => auth()->user()->username
                    ]);
                    $invitationPayment->saveOrFail();
                }
            }

            if ($this->isBackToList) {
                redirect($this->getResource()::getUrl('index'));
                Notification::make()
                    ->title('Saved successfully')
                    ->success()
                    ->send();
            }
        } catch (\Throwable $th) {
            dd($th);
            $this->validate();
            Log::error('Error Create Data', $th);
            Notification::make()
                ->title('Failed to save data.')
                ->danger()
                ->send();
        }
    }
}