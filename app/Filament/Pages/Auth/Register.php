<?php

namespace App\Filament\Pages\Auth;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use App\Models\SystemManager\Master\Role;
use App\Models\SystemManager\Setting\RoleMenu;
use App\Models\SystemManager\Setting\RoleMenuUser;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getUsernameFormComponent(), 
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
 
    protected function getUsernameFormComponent(): Component
    {
        return TextInput::make('username')
            ->required();
    }

    protected function getUserModel(): string
    {
        if (isset($this->userModel)) {
            return $this->userModel;
        }

        /** @var SessionGuard $authGuard */
        $authGuard = Filament::auth();

        /** @var EloquentUserProvider $provider */
        $provider = $authGuard->getProvider();

        return $this->userModel = $provider->getModel();
    }

    /* override untuk langsung assign registration ke role undangan sebagai user */
    protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::create($data);
        $role = Role::where('role', '=', 'Arsakarta Invitation - User')->first();
        $roleMenu = RoleMenu::where('role_id', '=', $role['id'])->first();

        RoleMenuUser::create([
            'role_menu_id'  => $roleMenu['id'],
            'user_id'       => $user['id'],
            'created_by'    => 'SYSTEM',
            'updated_by'    => 'SYSTEM',
        ]);
        return $user; 
    }
}
