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
        // Check if the database is SQLite
        if (config('database.default') === 'sqlite') {
            // If the database is SQLite, then I need to set the foreign key constraints to off
            DB::statement('PRAGMA foreign_keys = OFF;');
        } else {
            // If the database is not SQLite, then I need to disable foreign key constraints
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call([
            TruncateTable::class,
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            SettingSeeder::class,
        ]);

        if(config('database.default') === 'sqlite') {
            // If the database is SQLite, then I need to set the foreign key constraints to on
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            // If the database is not SQLite, then I need to enable foreign key constraints
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
