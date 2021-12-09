<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxes=[
    		['tax_type'=>'VAT',"percentage"=>'0.02']
    	];
   	    DB::table('taxes')->insert($taxes);
    }
}
