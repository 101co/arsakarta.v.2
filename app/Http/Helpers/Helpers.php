<?php

use App\Enums\Icons;
use App\Enums\ActionType;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

if (! function_exists('authUserMenu')) 
{
  function authUserMenu($code, $userId) 
  {
    if (auth()->user()->username === 'super.admin') {
      return true;
    }
    else {
      $authMenu = DB::table('sysmans_role_menu')
                    ->join('sysmans_role_menu_detail', 'sysmans_role_menu_detail.role_menu_id', '=', 'sysmans_role_menu.id')
                    ->join('sysmanm_menu', 'sysmanm_menu.id', '=', 'sysmans_role_menu_detail.menu_id')
                    ->join('sysmans_role_menu_user', 'sysmans_role_menu_user.role_menu_id', '=', 'sysmans_role_menu.id')
                    ->where('sysmanm_menu.code', '=', $code)
                    ->where('sysmans_role_menu_user.user_id', '=', $userId)
                    ->first();
      return $authMenu ? true : false;
    }
  }
}

if (! function_exists('getAllPackageActive')) 
{
  function getAllPackageActive($isActive) 
  {
    $arrayData = DB::table('packages')
                  ->where('is_active', '=', $isActive)
                  ->pluck('package_name', 'package_name')
                  ->toArray();

    return $arrayData;
  }
}

if (! function_exists('getCustomCreateFormAction')) 
{
  function getCustomCreateFormAction($label, $icon)
  {
    return Action::make('create')
            ->label($label ? $label : 'Save')
            ->icon($icon ? $icon->value : 'heroicon-c-check')
            ->submit('create')
            ->keyBindings(['mod+s'])
            ->iconSize(IconSize::Small);
  }
}

if (! function_exists('getCustomSaveFormAction')) 
{
  function getCustomSaveFormAction($label, $icon)
  {
    return Action::make('save')
      ->label($label ? $label : 'Save')
      ->icon($icon ? $icon->value : 'heroicon-c-check')
      ->submit('save')
      ->keyBindings(['mod+s'])
      ->iconSize(IconSize::Small)
      ->size(ActionSize::Small);
  }
}

if (! function_exists('getCustomCreateAnotherFormAction')) 
{
  function getCustomCreateAnotherFormAction($label, $icon)
  {
    if ($label && $icon)
    {
      return Action::make('createAnother')
          ->label($label ? $label : 'Save & Add Other')
          ->icon($icon ? $icon->value : 'heroicon-c-check')
          ->action('createAnother')
          ->keyBindings(['mod+shift+s'])
          ->color('gray')
          ->iconSize(IconSize::Small)
          ->size(ActionSize::Small);
    }
    return [];
  }
}

if (! function_exists('getCustomCancelFormAction')) 
{
  function getCustomCancelFormAction($label, $icon, $url)
  {
    if ($label && $icon)
    {
      return Action::make('cancel')
          ->label($label ? $label : '')
          ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . $url . ')')
          ->icon($icon ? $icon->value : '')
          ->color('gray')
          ->iconSize(IconSize::Small)
          ->size(ActionSize::Small);
          // ->extraAttributes(['onclick' => new HtmlString("return confirm('Are you sure you want to save?')")]);
    }
    return [];
  }
}

if (! function_exists('getCustomTableAction'))
{
  function getCustomTableAction($type, $label, $modalLabel, $icon, $enableAnother, $disableCancel, $isModal)
  {
    if ($type == ActionType::CREATE)
    {
      return CreateAction::make()
        ->mutateFormDataUsing((function (array $data): array {
            try {
              $data['created_by'] = auth()->user()->username;
              $data['updated_by'] = auth()->user()->username;
              return $data;
            } catch (\Throwable $th) {
              dd($th);
            }
        }))
        ->label($label)
        ->slideOver(!$isModal)
        ->icon($icon ? $icon->value : '')
        ->iconSize(IconSize::Small)
        ->modalHeading($modalLabel ? $modalLabel : '')
        ->modalWidth(MaxWidth::Large)
        ->modalSubmitActionLabel($label)
        ->stickyModalFooter()
        ->stickyModalHeader()
        ->createAnother($enableAnother ? $enableAnother : false)
        ->modalCancelAction($disableCancel ? false : null)
        ->size(ActionSize::Small);
    }
    else if ($type == ActionType::EDIT)
    {
      return EditAction::make()
        ->mutateFormDataUsing((function (array $data): array {
            $data['updated_by'] = auth()->user()->username;
            return $data;
        }))
        ->label($label)
        ->slideOver(!$isModal)
        ->icon($icon ? $icon->value : '')
        ->iconSize(IconSize::Small)
        ->hiddenLabel()
        ->modalHeading($modalLabel)
        ->modalWidth(MaxWidth::Large)
        ->modalSubmitActionLabel($label)
        ->modalCancelAction($disableCancel ? false : null)
        ->stickyModalFooter()
        ->stickyModalHeader()
        ->size(ActionSize::Small);
    }
    else if ($type == ActionType::DELETE)
    {
      return DeleteAction::make()
        ->modalHeading($modalLabel)
        ->hiddenLabel()
        ->size(ActionSize::Small);
    }
    else if ($type == ActionType::BULK_DELETE)
    {
      return DeleteBulkAction::make()
        ->label($label)
        ->iconSize(IconSize::Small)
        ->size(ActionSize::Small);
    }
  }
}