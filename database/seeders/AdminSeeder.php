<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin1',
            'email' => 'admin1@sample.com',
            'password' => Hash::make('12345678'),
            'created_at' => '2022/02/06 17:05:00'
        ]);
    }
}
