<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([MenuSeeder::class,]);
        $this->call([SubmenuSeeder::class,]);
        $this->call([TaxSeeder::class,]);
        $this->call([CouponSeeder::class,]);
    }
}
