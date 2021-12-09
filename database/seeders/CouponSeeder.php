<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons=[
    		['code'=>'GO2018',"description"=>'10% Discount every transaction',"discount"=>'0.10']
    	];
   	    DB::table('coupons')->insert($coupons);
    }
}
