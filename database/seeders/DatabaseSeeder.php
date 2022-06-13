<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            companySeeder::class,
            JobSeeder::class,
            OccupationSeeder::class,
            TagSeeder::class,
            PrefecturesSeeder::class,
            JobLocationSeeder::class,
            JobOccupationsSeeder::class,
            UsersSeeder::class,
            UserTagSeeder::class,
            JobTagSeeder::class,
        ]);
    }
}
