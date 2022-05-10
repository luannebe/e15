<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Note the use of the `updateOrCreate` Eloquent method
        # This is useful here because the email for each user has to be unique
        User::updateOrCreate(
            ['email' => 'jill@harvard.edu', 'name' => 'Jill Harvard'],
            ['password' => Hash::make('asdfasdf')]
        );
    
        User::updateOrCreate(
            ['email' => 'jamal@harvard.edu', 'name' => 'Jamal Harvard'],
            ['password' => Hash::make('asdfasdf')]
        );

        User::updateOrCreate(
            ['email' => 'lu@flyingdog.nu', 'name' => 'Luann Ebert'],
            ['password' => Hash::make('asdfasdf')]
        );
    }
}