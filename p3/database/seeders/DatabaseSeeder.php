<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(CategoriesTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(CategoryReportTableSeeder::class); 
        $this->call(UsersTableSeeder::class);
    }
}