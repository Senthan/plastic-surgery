<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();

        \App\User::insert([
            [
                'name' => 'admin',
                'email' => 'siva@plastic.com',
                'password' => bcrypt('siva@plastic'),
                'role_id' => 1,
            ],
        ]);
    }
}
