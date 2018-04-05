<?php

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
        DB::table('users')->insert([
            'name' => 'Jordan',
            'api_key' => str_random(10),
            'email' => 'jordanrichmeier@lender411.com', //wishful thinking
            'password' => bcrypt('secret'),
        ]);
    }
}
