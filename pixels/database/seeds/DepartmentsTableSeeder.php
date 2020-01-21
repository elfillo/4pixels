<?php

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Department::class, 15)->create();

        $users = User::all();

        Department::All()->each(function ($departments) use ($users){
            $departments->users()->attach(
                $users->random(rand(1, 7))->pluck('id')->toArray()
            );
        });
    }
}
