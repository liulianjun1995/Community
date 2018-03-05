<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'), // admin
        'sex' => '男',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\Admin::class, function (Faker $faker) {
    static $password;

    return [
        'username' => $faker->name,
        'password' => $password ?: $password = bcrypt('admin'), // admin
    ];
});

$factory->define(App\Model\Post::class, function (Faker $faker) {

    return [
        'user_id' => 1,
        'category_id' =>1,
        'title' => '这是测试贴',
        'content' => "这是测试贴的内容",
        'is_closed' =>0,
        'is_top' =>0,
        'is_sticky' =>0,
        'renqi' =>0,
        'status' =>0,
        'reward' =>20,
    ];
});
