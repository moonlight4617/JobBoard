<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class JobLocationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('job_locations')->insert([
      [
        'jobs_id' => '1',
        'prefectures_id' => '1',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => '2',
        'prefectures_id' => '2',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => '3',
        'prefectures_id' => '3',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => '3',
        'prefectures_id' => '4',
        'created_at' => '2022/02/06 17:05:00'
      ]
    ]);
  }
}
