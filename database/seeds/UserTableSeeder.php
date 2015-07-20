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
        DB::table('users')->insert([
            'name' => 'Nikita',
            'surname' => 'Gorshkov',
            'email' => 'nikita1104@mail.ru',
            'password' => bcrypt('12345'),
            'phone' => '8 (900) 786-23-32',
            'organization' => 'vizant',
            'role' => 'admin',
            'remember_token' => str_random(10)
        ]);
    }
}
