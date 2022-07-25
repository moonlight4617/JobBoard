<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Jobs;
use App\Models\Prefecture;

class JobLocationSeeder extends Seeder
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
    $pref1Id = Prefecture::where('prefecture', '東京都')->value('id');
    $pref2Id = Prefecture::where('prefecture', '神奈川県')->value('id');
    $pref3Id = Prefecture::where('prefecture', '千葉県')->value('id');
    $pref4Id = Prefecture::where('prefecture', '埼玉県')->value('id');

    DB::table('job_locations')->insert([
      [
        'jobs_id' => $job1Id,
        'prefectures_id' => $pref1Id,
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => $job2Id,
        'prefectures_id' => $pref2Id,
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => $job3Id,
        'prefectures_id' => $pref3Id,
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'jobs_id' => $job3Id,
        'prefectures_id' => $pref4Id,
        'created_at' => '2022/02/06 17:05:00'
      ]
      // [
      //   'jobs_id' => $job1Id,
      //   'prefectures_id' => '1',
      //   'created_at' => '2022/02/06 17:05:00'
      // ],
      // [
      //   'jobs_id' => $job2Id,
      //   'prefectures_id' => '2',
      //   'created_at' => '2022/02/06 17:05:00'
      // ],
      // [
      //   'jobs_id' => $job3Id,
      //   'prefectures_id' => '3',
      //   'created_at' => '2022/02/06 17:05:00'
      // ],
      // [
      //   'jobs_id' => '3',
      //   'prefectures_id' => '4',
      //   'created_at' => '2022/02/06 17:05:00'
      // ]
    ]);
  }
}
