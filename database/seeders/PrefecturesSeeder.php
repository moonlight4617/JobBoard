<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PrefecturesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('prefectures')->insert([
      [
        'prefecture' => '東京都',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'prefecture' => '神奈川県',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'prefecture' => '千葉県',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'prefecture' => '埼玉県',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'prefecture' => '群馬県',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'prefecture' => '茨城県',
        'created_at' => '2022/02/06 17:05:00'
      ],
      [
        'prefecture' => '栃木県',
        'created_at' => '2022/02/06 17:05:00'
      ],
    ]);
  }
}
