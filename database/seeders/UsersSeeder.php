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
        DB::table('users')->insert([
            [
                'name' => 'user1',
                'email' => 'user1@sample.com',
                'password' => Hash::make('12345678'),
                'created_at' => '2022/02/06 17:05:00',
                'catch' => '元気だけが取り柄です！',
                'intro' => '元気な男の紹介文',
                'license' => '調理師免許',
                'career' => '調理専門学校卒業',
                'hobby' => '映画鑑賞',
            ],
            [
                'name' => 'user2',
                'email' => 'user2@sample.com',
                'password' => Hash::make('12345678'),
                'created_at' => '2022/02/06 17:05:00',
                'catch' => '前職でも飲食をやってました！',
                'intro' => '前職で飲食をやっていた人の紹介文',
                'license' => '普通自動車免許',
                'career' => '四大卒',
                'hobby' => '散歩',
            ],
            [
                'name' => 'user3',
                'email' => 'user3@sample.com',
                'password' => Hash::make('12345678'),
                'created_at' => '2022/02/06 17:05:00',
                'catch' => '新しいことにチャレンジしてみたい！',
                'intro' => '新しいことにチャレンジしたい人の紹介文',
                'license' => '英検３級',
                'career' => '高卒',
                'hobby' => '野球',
            ]
        ]);
    }
}
