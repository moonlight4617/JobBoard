<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Jobs;
use App\Models\Occupation;

class JobOccupationsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $job1Id = Jobs::where('job_name', 'イタリアンのキッチン')->value('id');
    $job2Id = Jobs::where('job_name', '老舗割烹料理屋のホール')->value('id');
    $job3Id = Jobs::where('job_name', 'パティシエ')->value('id');
    $occu1Id = Occupation::where('name', 'キッチン')->value('id');
    $occu2Id = Occupation::where('name', 'ホール')->value('id');
    $occu3Id = Occupation::where('name', 'パティシエ')->value('id');

    DB::table('job_occupations')->insert([
      [
        'jobs_id' => $job1Id,
        'occupations_id' => $occu1Id,
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => $job2Id,
        'occupations_id' => $occu2Id,
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => $job3Id,
        'occupations_id' => $occu3Id,
        'created_at' => '2022/02/06 17:05:00'
      ]
      // [
      //   'jobs_id' => '1',
      //   'occupations_id' => '1',
      //   'created_at' => '2022/02/06 17:05:00'
      // ],
      // [
      //   'jobs_id' => '2',
      //   'occupations_id' => '2',
      //   'created_at' => '2022/02/06 17:05:00'
      // ],
      // [
      //   'jobs_id' => '3',
      //   'occupations_id' => '6',
      //   'created_at' => '2022/02/06 17:05:00'
      // ]
    ]);
  }
}
