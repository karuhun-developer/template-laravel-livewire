<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         *
         * Mysql Foreign Key Check
         * DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         * DB::statement('SET FOREIGN_KEY_CHECKS=1;');
         *
         */
        DB::statement('PRAGMA foreign_keys = OFF;');

        $this->call([
            TruncateTable::class,
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            SettingSeeder::class,
        ]);

        DB::statement('PRAGMA foreign_keys = ON;');
    }
}
