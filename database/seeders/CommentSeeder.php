<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'user_id' => 1,
            'product_id' => 1,
            'title' =>'iphone đẹp á',
            'content' =>'iphone đẹp á nha',
            'status' => 1
        ]);
    }
}
