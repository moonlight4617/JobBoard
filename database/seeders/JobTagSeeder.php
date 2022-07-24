<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class JobTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag_to_jobs')->insert([
            [
                'jobs_id' => '1',
                'tags_id' => '10',
            ],
            [
                'jobs_id' => '1',
                'tags_id' => '20',
            ],
            [
                'jobs_id' => '1',
                'tags_id' => '25',
            ],
            [
                'jobs_id' => '2',
                'tags_id' => '12',
            ],
            [
                'jobs_id' => '2',
                'tags_id' => '24',
            ],
            [
                'jobs_id' => '3',
                'tags_id' => '22',
            ],
            [
                'jobs_id' => '3',
                'tags_id' => '24',
            ]
        ]);
    }
}
