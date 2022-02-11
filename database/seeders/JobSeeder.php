<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            [
                'companies_id' => 1,
                'job_name' => 'イタリアンのキッチン',
                'detail' => '赤坂にあるオシャレなイタリアンレストランでのキッチン業務になります。とかなんとか',
                'conditions' => '未経験可',
                'duty_hours' => '9:00~21:00',
                'low_salary' => '260',
                'high_salary' => '600',
                'holiday' => 'シフト制。月６回',
                'benefits' => '社会保険完備',
            ],
            [
                'companies_id' => 2,
                'job_name' => '老舗割烹料理屋のホール',
                'detail' => '創設50年を越える歴史ある料理屋です。とかなんとか',
                'conditions' => '経験優遇',
                'duty_hours' => '11:00~23:00',
                'low_salary' => '300',
                'high_salary' => '480',
                'holiday' => 'シフト制。月8回',
                'benefits' => '社会保険完備',
            ],
            [
                'companies_id' => 3,
                'job_name' => 'パティシエ',
                'detail' => 'パティシエ誰々監修の洋菓子店でパティシエ募集します。とかなんとか',
                'conditions' => '特になし',
                'duty_hours' => '8:00~19:00',
                'low_salary' => '240',
                'high_salary' => '360',
                'holiday' => 'シフト制。月8回',
                'benefits' => '社会保険完備',
            ],
        ]);
    }
}