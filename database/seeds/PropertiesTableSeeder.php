<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            [
                'name' => 'Тип',
                'real_name' => 'type',
                'type' => 1
            ],
            [
                'name' => 'Страна',
                'real_name' => 'country',
                'type' => 1
            ],
            [
                'name' => 'Состав продукта',
                'real_name' => 'sostav-produkta',
                'type' => 2
            ]
        ]);
    }
}
