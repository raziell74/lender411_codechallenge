<?php

use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Team::class, 3)->create()->each(function($team) {
            $team->players()->saveMany(factory('App\Player', 11)->make());
        });
    }
}
