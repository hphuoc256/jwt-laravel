<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReplyCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reply_comments')->insert([
            'user_id' => 1,
            'comment_id' => 1,
            'title' =>'iphone',
            'content' =>'iphone đẹp gì mà đẹp',
            'status' => 1
        ]);
    }
}
