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
        DB::table('users')->insert(['name' => 'George', 'email' => 'U1556029@unimail.hud.ac.uk', 'password' => bcrypt('Patch7888')]);
    }
}
