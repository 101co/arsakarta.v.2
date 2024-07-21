<?php

use App\Enums\ActionType;
use App\Enums\Icons;
use Filament\Actions\Action;
use Filament\Support\Enums\ActionSize;
use Illuminate\Support\Facades\DB;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

if (! function_exists('authUserMenu')) 
{
  function authUserMenu($code, $userId) 
  {
    $authMenu = DB::table('role_menus')
                  ->join('role_menu_details', 'role_menu_details.role_menu_id', '=', 'role_menus.id')
                  ->join('menus', 'menus.id', '=', 'role_menu_details.menu_id')
                  ->join('role_menu_users', 'role_menu_users.role_menu_id', '=', 'role_menus.id')
                  ->where('menus.code', '=', $code)
                  ->where('role_menu_users.user_id', '=', $userId)
                  ->first();

    return $authMenu ? true : false;
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
    }
    return [];
  }
}

if (! function_exists('getCustomTableAction'))
{
  function getCustomTableAction($type, $label, $modalLabel, $icon, $enableAnother, $disableCancel)
  {
    if ($type == ActionType::CREATE)
    {
      return CreateAction::make()
        ->mutateFormDataUsing((function (array $data): array {
            $data['created_by'] = auth()->user()->username;
            $data['updated_by'] = auth()->user()->username;
            return $data;
        }))
        ->label($label)
        ->icon($icon ? $icon->value : '')
        ->iconSize(IconSize::Small)
        ->modalHeading($modalLabel ? $modalLabel : '')
        ->modalWidth(MaxWidth::Medium)
        ->modalSubmitActionLabel($label)
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
        ->icon($icon ? $icon->value : '')
        ->iconSize(IconSize::Small)
        ->hiddenLabel()
        ->modalHeading($modalLabel)
        ->modalWidth(MaxWidth::Medium)
        ->modalSubmitActionLabel($label)
        ->modalCancelAction($disableCancel ? false : null)
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