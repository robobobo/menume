<?php

use Illuminate\Database\Seeder;
use App\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = Menu::all();
        foreach ($menus as $menu ) {
            $menu->menuSections()->saveMany(factory('App\MenuSection',rand(3,5))->make());
            $menu->menuItems()->saveMany(factory('App\MenuItem',rand(8,20))->make());
        }
    }
}
