<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Models\User;

class UserTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1Id = User::where('name', 'user1')->value('id');
        $user2Id = User::where('name', 'user2')->value('id');
        $user3Id = User::where('name', 'user3')->value('id');
        $tag1Id = Tag::where('tag_name', '飲食業経験者')->value('id');
        $tag2Id = Tag::where('tag_name', '食品衛生管理者資格有り')->value('id');
        $tag3Id = Tag::where('tag_name', 'その他資格有り')->value('id');
        $tag4Id = Tag::where('tag_name', 'SNSフォロワー多数')->value('id');

        DB::table('tag_to_users')->insert([
            [
                'users_id' => $user1Id,
                'tags_id' => $tag1Id,
            ],
            [
                'users_id' => $user1Id,
                'tags_id' => $tag2Id,
            ],
            [
                'users_id' => $user2Id,
                'tags_id' => $tag1Id,
            ],
            [
                'users_id' => $user3Id,
                'tags_id' => $tag3Id,
            ],
            [
                'users_id' => $user3Id,
                'tags_id' => $tag4Id,
            ]
            // [
            //     'users_id' => '1',
            //     'tags_id' => '2',
            // ],
            // [
            //     'users_id' => '1',
            //     'tags_id' => '6',
            // ],
            // [
            //     'users_id' => '2',
            //     'tags_id' => '2',
            // ],
            // [
            //     'users_id' => '3',
            //     'tags_id' => '7',
            // ],
            // [
            //     'users_id' => '3',
            //     'tags_id' => '8',
            // ]
        ]);
    }
}
