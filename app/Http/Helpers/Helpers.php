<?php

use Illuminate\Support\Facades\DB;
use App\Models\SystemManager\Master\Menu;
use App\Models\SystemManager\Setting\RoleMenu;
use App\Models\SystemManager\Setting\RoleMenuUser;
use App\Models\SystemManager\Setting\RoleMenuDetail;

if (! function_exists('authUserMenu')) {
  function authUserMenu($code, $userId) {
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