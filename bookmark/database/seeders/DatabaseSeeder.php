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
        # Because `books` will be associated with `authors`,
        # authors should be seeded first
        $this->call(AuthorsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BookUserTableSeeder::class); # Because this seeder is dependent on Books and Users, it should be invoked last
    }
}