<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\MenuPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
   private function makeAllMenuWithPermission($allMenu, $allMenuPermission, $userRolePermission)
   {
      // mapping menu permission with menu
      $allMenuWithPermission = $allMenu->map(function ($menu) use ($allMenuPermission) {
         $menu['permission_id'] = $allMenuPermission->filter(function ($permission) use ($menu) {
            return $menu->id == $permission->menu_id;
         });
         return $menu;
      });

      // filtering all menu with permission with user role
      $allMenuWithPermission = $allMenuWithPermission->filter(function ($menu) use ($userRolePermission) {
         $isMenuValid = false;
         foreach ($menu->permission_id as $menuPermission) {
            foreach ($userRolePermission as $permission) {
               if ($permission->id == $menuPermission->permission_id) {
                  $isMenuValid = true;
               }
            }
         }
         return $isMenuValid;
      });
      return $allMenuWithPermission;
   }

   private function mapChildMenuWithMenu($allMenuWithPermission)
   {
      $parentMenu = collect([]);

      // make parent menu
      foreach ($allMenuWithPermission as $menu) {
         if ($menu['parent_id'] == null) {
            $parentMenu->push($menu);
         }
      }

      // make child menu
      foreach ($parentMenu as $pMenu) {
         $pMenu->child = collect([]);
         foreach ($allMenuWithPermission as $menu) {
            if ($menu['parent_id'] == $pMenu['id']) {
               $pMenu->child->push($menu);
            }
         }
         // sort child
         if ($pMenu->child->isNotEmpty()) {
            $pMenu->child = $pMenu->child->sortBy('order');
         }
      }
      return $parentMenu;
   }

   private function adminMenu()
   {
      $menus = Menu::where('is_active', 1)->get();
      $menuPermissions = MenuPermission::all();
      $userRolePermission = @Auth::user()->roles[0]->permissions ?? [];
      $allMenuWithPermission = $this->makeAllMenuWithPermission($menus, $menuPermissions, $userRolePermission);
      $parentMenu = $this->mapChildMenuWithMenu($allMenuWithPermission);
      return $parentMenu->sortBy('order');
   }

   private function petOwnerMenu()
   {
      $allMenu = Menu::where('is_active', 1)
         ->where('is_pet_owner', 1)
         ->get();
      $parentMenu = $this->mapChildMenuWithMenu($allMenu);
      return $parentMenu->sortBy('order');
   }

   public function boot()
   {
      view()->composer(
         'layouts.master.sidebar',
         function ($view) {
            $isPetOwner = Auth::user()->roles[0]->id == 1;
            $parentMenu = $isPetOwner ?  $this->petOwnerMenu() : $this->adminMenu();

            View::share('menus', $parentMenu);
         }
      );
      view()->composer(
         'layouts.pet-owner.navbar',
         function ($view) {
            View::share('menus', $this->petOwnerMenu());
         }
      );
   }
}
