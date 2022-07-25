<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Jobs;
use App\Models\Tag;

class JobTagSeeder extends Seeder
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
        $tag1Id = Tag::where('tag_name', 'イタリアン')->value('id');
        $tag2Id = Tag::where('tag_name', 'オープニングスタッフ')->value('id');
        $tag3Id = Tag::where('tag_name', '業界未経験歓迎')->value('id');
        $tag4Id = Tag::where('tag_name', '和食')->value('id');
        $tag5Id = Tag::where('tag_name', '残業月40h以内')->value('id');
        $tag6Id = Tag::where('tag_name', '上場企業')->value('id');

        DB::table('tag_to_jobs')->insert([
            [
                'jobs_id' => $job1Id,
                'tags_id' => $tag1Id,
            ],
            [
                'jobs_id' => $job1Id,
                'tags_id' => $tag2Id,
            ],
            [
                'jobs_id' => $job1Id,
                'tags_id' => $tag3Id,
            ],
            [
                'jobs_id' => $job2Id,
                'tags_id' => $tag4Id,
            ],
            [
                'jobs_id' => $job2Id,
                'tags_id' => $tag5Id,
            ],
            [
                'jobs_id' => $job3Id,
                'tags_id' => $tag6Id,
            ],
            [
                'jobs_id' => $job3Id,
                'tags_id' => $tag5Id,
            ]
            // [
            //     'jobs_id' => '1',
            //     'tags_id' => '10',
            // ],
            // [
            //     'jobs_id' => '1',
            //     'tags_id' => '20',
            // ],
            // [
            //     'jobs_id' => '1',
            //     'tags_id' => '25',
            // ],
            // [
            //     'jobs_id' => '2',
            //     'tags_id' => '12',
            // ],
            // [
            //     'jobs_id' => '2',
            //     'tags_id' => '24',
            // ],
            // [
            //     'jobs_id' => '3',
            //     'tags_id' => '22',
            // ],
            // [
            //     'jobs_id' => '3',
            //     'tags_id' => '24',
            // ]
        ]);
    }
}
