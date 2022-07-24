<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class JobOccupationsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('job_occupations')->insert([
      [
        'jobs_id' => '1',
        'occupations_id' => '1',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => '2',
        'occupations_id' => '2',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => '3',
        'occupations_id' => '6',
        'created_at' => '2022/02/06 17:05:00'
      ]
    ]);
  }
}
