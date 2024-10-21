<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

use App\Enums\Icons;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Radio;
use Filament\Support\Enums\IconSize;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use App\Models\DigitalInvitation\Master\Package;
use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource;

class CreateInvitation extends CreateRecord {
    protected static string $resource = InvitationResource::class;

    // protected function getFormActions(): array {
    //     return [
    //         Action::make('create')
    //             ->submit('create')
    //             ->disabled(fn () => $this->data['is_paid'] ? false : true)
    //             ->keyBindings(['mod+s'])
    //     ];
    // }

    public function openInfoPaketModal() {
        dd('modal info');
        // $this->dispatch('open-modal', id:'modal-info-paket');
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

            // dd($this->data);
        } catch (\Throwable $th) {
        }
    }

    function disabledChoosePackageButton($set) {
        $buttonDisabled = false;

        if ((!empty($this->data['package_id']) && $this->data['package_id']))
            $buttonDisabled = true;
            
        if ($this->data['is_paid'])
            $buttonDisabled = true;

        return $buttonDisabled;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $data['theme_id'] = auth()->user()->id;
        $data['song_id'] = auth()->user()->id;
        $data['is_active'] = true;
        $data['created_by'] = auth()->user()->username;
        $data['updated_by'] = auth()->user()->username;
        dd($data);
        return $data;
    }
}
