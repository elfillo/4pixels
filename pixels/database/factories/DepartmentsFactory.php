<?php
use Faker\Generator as Faker;
use App\Models\Department;

$factory->define(Department::class, function (Faker $faker) {

    $filepath = public_path('logo');

    if(!File::exists($filepath)){
        File::makeDirectory($filepath);
    }

    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'logo' => rand(1,4).'.jpeg'
    ];
});
