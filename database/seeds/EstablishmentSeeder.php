<?php

use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $establishments = factory('App\Establishment',10)->create()->each(function ($establishment){
            $establishment->menus()->save(factory('App\Menu')->make());
        });
    }
}
