<?php

use Faker\Generator as Faker;

/**
 * Team table factory
 */

$factory->define(App\Team::class, function (Faker $faker) {
    return ['name' => $faker->company];
});
