<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

use Closure;
use Midtrans\Snap;
use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Split;
use Filament\Support\Enums\IconSize;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use function PHPUnit\Framework\isNull;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\DigitalInvitation\Master\Package;
use App\Models\DigitalInvitation\Master\EventCategory;
use App\Models\DigitalInvitation\Transaction\Invitation;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource;
use Carbon\Carbon;

class CreateInvitationCustom extends Page implements HasForms {
    use InteractsWithForms;

    public ?array $data = [];
    public $newPaymentId = null;
    public $isMoreThanEditingDay = false;
    protected static string $resource = InvitationResource::class;
    protected static string $view = 'filament.resources.digital-invitation.transaction.invitation-resource.pages.create-invitation-custom';
    protected $listeners = [
        'payment-success'   => 'paymentSuccess',
        'payment-closed'    => 'paymentClosed'
    ];

    public function getTitle(): string | Htmlable {
        return __('Undanganmu');
    }

    public function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    public function mount(Invitation $record): void {
        $this->form->fill($record->toArray());
        $this->checkDataIsMoreThanEditingDay();
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
                                        ->rule(function (Get $get, Component $component) {
                                            return static function (string $attr, $value, Closure $fail) use ($get, $component) {
                                                $existingSlug = Invitation::where('slug', $value)
                                                                ->where('id', '<>', $get('id'))
                                                                ->first();

                                                if ($existingSlug) {
                                                    $fail("URL (Slug) already taken.");
                                                }
                                            };
                                        })
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
                            ]),
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
            $isTrialPackage = Package::where('is_trial', true)
                        ->where('is_active', true)
                        ->where('id', '=', $this->data['package_id'])
                        ->first();
            
            if ($isTrialPackage) {
                $this->data['is_paid'] = true;
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
    
    public function paymentSuccess($order_id) {
        try {
            $this->newPaymentId = $order_id;
            $this->data['order_id'] = $this->newPaymentId;
            $this->data['is_paid'] = true;
    
            Notification::make()
                ->title('Paymen success.')
                ->success()
                ->send();
        } catch (\Throwable $th) {
            Log::error('Error Payment Success', $th);
            Notification::make()
                ->title('Payment failed.')
                ->danger()
                ->send();
        }
    }

    public function paymentClosed() {
        $this->newPaymentId = null;
        // $this->data['order_id'] = null;
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
            if (!empty($this->data['id']) && $this->data['id']) {
                $updatedData = Invitation::find($this->data['id']);
                $updatedData['name']                = $this->data['name'];
                $updatedData['slug']                = $this->data['slug'];
                $updatedData['event_category_id']   = $this->data['event_category_id'];
                $updatedData['package_id']          = $this->data['package_id'];
                $updatedData['user_id']             = $this->data['user_id'];
                $updatedData['is_paid']             = $this->data['is_paid'];
                $updatedData['updated_by']          = auth()->user()->username;
                $updatedData['order_id'] = $this->data['order_id'];
                $updatedData->save();
            }
            else {
                $savedData = new Invitation();
                $savedData->fill([
                    'name'                  => $this->data['name'],
                    'slug'                  => $this->data['slug'],
                    'event_category_id'     => $this->data['event_category_id'],
                    'package_id'            => $this->data['package_id'],
                    'user_id'               => auth()->user()->id,
                    'is_paid'               => $this->data['is_paid'],
                    'is_active'             => true,
                    'created_by'            => auth()->user()->username,
                    'updated_by'            => auth()->user()->username,
                    'order_id'              => $this->data['order_id']
                ]);
                $savedData->saveOrFail();
            }

            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();

            redirect($this->getResource()::getUrl('index'));
        } catch (\Throwable $th) {
            $this->validate();
            Log::error('Error Create Data', $th);
            Notification::make()
                ->title('Failed to save data.')
                ->danger()
                ->send();
        }
    }
}