<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag_to_users')->insert([
            [
                'users_id' => '1',
                'tags_id' => '2',
            ],
            [
                'users_id' => '1',
                'tags_id' => '6',
            ],
            [
                'users_id' => '2',
                'tags_id' => '2',
            ],
            [
                'users_id' => '3',
                'tags_id' => '7',
            ],
            [
                'users_id' => '3',
                'tags_id' => '8',
            ]
        ]);
    }
}
