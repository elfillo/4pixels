<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name'      => 'Admin',
            'email'     => 'admin@test.loc',
            'email_verified_at' => now(),
            'password'  => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        factory(\App\Models\User::class, 15)->create();
    }
}
