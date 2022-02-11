<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class companySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => 'Company1',
                'email' => 'company1@sample.com',
                'password' => Hash::make('12345678'),
                'intro' => '企業紹介文',
                'tel' => '0312345678',
                'post_code' => '1234567',
                'address' => '東京都西東京市',
                'homepage' => 'www.homepage.co.jp',
                'created_at' => '2022/02/06 17:05:00',
            ],
            [
                'name' => 'Company2',
                'email' => 'company2@sample.com',
                'password' => Hash::make('12345678'),
                'intro' => '企業紹介文',
                'tel' => '0312345678',
                'post_code' => '1234567',
                'address' => '東京都西東京市',
                'homepage' => 'www.homepage.co.jp',
                'created_at' => '2022/02/06 17:05:00',
            ],
            [
                'name' => 'Company3',
                'email' => 'company3@sample.com',
                'password' => Hash::make('12345678'),
                'intro' => '企業紹介文',
                'tel' => '0312345678',
                'post_code' => '1234567',
                'address' => '東京都西東京市',
                'homepage' => 'www.homepage.co.jp',
                'created_at' => '2022/02/06 17:05:00',
            ],
            [
                'name' => 'Company4',
                'email' => 'company4@sample.com',
                'password' => Hash::make('12345678'),
                'intro' => '企業紹介文',
                'tel' => '0312345678',
                'post_code' => '1234567',
                'address' => '東京都西東京市',
                'homepage' => 'www.homepage.co.jp',
                'created_at' => '2022/02/06 17:05:00',
            ],
            [
                'name' => 'Company5',
                'email' => 'company5@sample.com',
                'password' => Hash::make('12345678'),
                'intro' => '企業紹介文',
                'tel' => '0312345678',
                'post_code' => '1234567',
                'address' => '東京都西東京市',
                'homepage' => 'www.homepage.co.jp',
                'created_at' => '2022/02/06 17:05:00',
            ],
            [
                'name' => 'Company6',
                'email' => 'company6@sample.com',
                'password' => Hash::make('12345678'),
                'intro' => '企業紹介文',
                'tel' => '0312345678',
                'post_code' => '1234567',
                'address' => '東京都西東京市',
                'homepage' => 'www.homepage.co.jp',
                'created_at' => '2022/02/06 17:05:00',
            ],
        ]);
    }
}
