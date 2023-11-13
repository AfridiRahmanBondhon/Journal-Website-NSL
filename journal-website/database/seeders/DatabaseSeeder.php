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
        $arr = [
            MenuSeeder::class,
            AdminSeeder::class,
            RoleSeeder::class,
            SiteSettingsSeeder::class,
            SliderDetailsSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class,
        ];

        $this->call($arr);
    }
}
