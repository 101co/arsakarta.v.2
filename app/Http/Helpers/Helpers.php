<?php

use Illuminate\Support\Facades\DB;
use Filament\Actions\Action;

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

if (! function_exists('getCustomCreateFormAction')) 
{
  function getCustomCreateFormAction($label, $icon)
  {
    return Action::make('create')
            ->label($label ? $label : 'Save')
            ->icon($icon ? $icon->value : 'heroicon-c-check')
            ->submit('create')
            ->keyBindings(['mod+s']);
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
          ->color('gray');
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
          ->color('gray');
    }
    return [];
  }
}