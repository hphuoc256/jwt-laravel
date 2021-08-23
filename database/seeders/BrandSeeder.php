<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'iPhone',
            'category_id' => 1,
            'content' =>'iphone đẹp á nha cái quần què',
            'status' => 1
        ]);
    }
}
