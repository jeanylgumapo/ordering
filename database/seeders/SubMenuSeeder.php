<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $submenu=[
        	['item_name'=>'Hotdog', 'menu_id'=>'1','price'=>'12'],
        	['item_name'=>'Cheese Burger', 'menu_id'=>'1','price'=>'39'],
        	['item_name'=>'Fries', 'menu_id'=>'1','price'=>'20'],
        	['item_name'=>'Coke', 'menu_id'=>'2','price'=>'12'],
        	['item_name'=>'Sprite', 'menu_id'=>'2','price'=>'12'],
        	['item_name'=>'Tea', 'menu_id'=>'2','price'=>'10'],
        	['item_name'=>'Chicken Combo Meal', 'menu_id'=>'3','price'=>'89'],
        	['item_name'=>'Pork Combo Meal', 'menu_id'=>'3','price'=>'100'],
        	['item_name'=>'Fish Combo Meal', 'menu_id'=>'3','price'=>'99']
        ];
        DB::table('submenus')->insert($submenu);
    }
}
