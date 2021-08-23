<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
            'name' => 'IP X',
            'content' => 'aaaaaa',
            'price' => 100,
            'sellprice' => 90,
            'content' => 'asda aca',
            'ordernum' => 1,
            'category_id' => 1,           
            ],
        );
    }
}
