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
        DB::table('Users')->insert([
            [
                'name' => 'Петр',
                'surname' => 'Петров',
                'email' => 'admin1@mail.ru',
                'password' => bcrypt('admin'),
                'phone' => '8 (900) 777-77-77',
                'organization' => 'ruchaicof',
                'role' => 'admin',
                'remember_token' => ''
            ],
            [
                'name' => 'Сидор',
                'surname' => 'Сидоров',
                'email' => 'admin2@mail.ru',
                'password' => bcrypt('admin'),
                'phone' => '8 (900) 777-77-78',
                'organization' => 'ruchaicof',
                'role' => 'admin',
                'remember_token' => ''
            ],
            [
                'name' => 'Иван',
                'surname' => 'Иванов',
                'email' => 'client1@mail.ru',
                'password' => bcrypt('client'),
                'phone' => '8 (901) 777-77-77',
                'organization' => 'neruchaicof',
                'role' => 'client',
                'remember_token' => ''
            ],
            [
                'name' => 'Николай',
                'surname' => 'Николаев',
                'email' => 'client2@mail.ru',
                'password' => bcrypt('client'),
                'phone' => '8 (901) 777-77-78',
                'organization' => 'neruchaicof',
                'role' => 'client',
                'remember_token' => ''
            ]
        ]);
    }
}
