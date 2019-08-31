<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'test',
            'email' => 'admin@test.nl',
            'verified' => 1,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make('admin'),
            'role' => 3
        ]);
        User::create([
            'first_name' => 'User',
            'last_name' => 'test',
            'email' => 'user@test.nl',
            'verified' => 1,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make('secret'),
            'role' => 1
        ]);
    }
}
