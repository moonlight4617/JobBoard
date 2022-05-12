<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'tag_name' => 'マネジメント経験あり',
                'subject' => '0'
            ],
            [
                'tag_name' => '飲食業経験者',
                'subject' => '0'
            ],
            [
                'tag_name' => '大型店経験あり(客席100~)',
                'subject' => '0'
            ],
            [
                'tag_name' => 'ソムリエ資格有り',
                'subject' => '0'
            ],
            [
                'tag_name' => '防火防災管理者資格有り',
                'subject' => '0'
            ],
            [
                'tag_name' => '食品衛生管理者資格有り',
                'subject' => '0'
            ],
            [
                'tag_name' => 'その他資格有り',
                'subject' => '0'
            ],
            [
                'tag_name' => 'SNSフォロワー多数',
                'subject' => '0'
            ],
            [
                'tag_name' => '海外勤務経験有り',
                'subject' => '0'
            ],
            [
                'tag_name' => 'イタリアン',
                'subject' => '1'
            ],
            [
                'tag_name' => 'フレンチ',
                'subject' => '1'
            ],
            [
                'tag_name' => '和食',
                'subject' => '1'
            ],
            [
                'tag_name' => '中華',
                'subject' => '1'
            ],
            [
                'tag_name' => '居酒屋',
                'subject' => '1'
            ],
            [
                'tag_name' => 'ベーカリー',
                'subject' => '1'
            ],
            [
                'tag_name' => 'カフェ',
                'subject' => '1'
            ],
            [
                'tag_name' => '店長候補',
                'subject' => '1'
            ],
            [
                'tag_name' => 'マネージャー・SV候補',
                'subject' => '1'
            ],
            [
                'tag_name' => '料理長候補',
                'subject' => '1'
            ],
            [
                'tag_name' => 'オープニングスタッフ',
                'subject' => '1'
            ],
            [
                'tag_name' => 'ゴーストレストラン',
                'subject' => '1'
            ],
            [
                'tag_name' => '上場企業',
                'subject' => '1'
            ],
            [
                'tag_name' => '個人経営',
                'subject' => '1'
            ],
            [
                'tag_name' => '残業月40h以内',
                'subject' => '1'
            ],
            [
                'tag_name' => '業界未経験歓迎',
                'subject' => '1'
            ],
            [
                'tag_name' => '月8日以上休み',
                'subject' => '1'
            ],
            [
                'tag_name' => '独立支援制度有り',
                'subject' => '1'
            ],
            [
                'tag_name' => '社会保険完備',
                'subject' => '1'
            ],
            [
                'tag_name' => '産休・育休休暇制度有り',
                'subject' => '1'
            ],
            [
                'tag_name' => '寮・社宅有り',
                'subject' => '1'
            ]
        ]);
    }
}
