<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu=[
    		['name'=>'Burger'],
    		['name'=>'Beverages'],
    		['name'=>'Combo Meals']
    	];
   	DB::table('menus')->insert($menu);
    }
}
