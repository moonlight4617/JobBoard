<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupations')->insert([
            [
                'name' => 'キッチン'
            ],
            [
                'name' => 'ホール'
            ],
            [
                'name' => 'ブーランジェ'
            ],
            [
                'name' => 'バーテンダー'
            ],
            [
                'name' => 'バリスタ'
            ],
            [
                'name' => 'パティシエ'
            ],
            [
                'name' => 'ソムリエ'
            ],
            [
                'name' => '洗い場'
            ],
            [
                'name' => '配達スタッフ'
            ],
            [
                'name' => '販売スタッフ'
            ],
            [
                'name' => 'レセプション'
            ],
            [
                'name' => '本部スタッフ'
            ],
            [
                'name' => 'その他'
            ]
        ]);
    }
}
