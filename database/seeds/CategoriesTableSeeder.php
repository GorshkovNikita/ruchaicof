<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('Categories')->insert([
            [
                'parent_id' => null,
                'name' => 'Чай',
                'table_name' => 'Tea',
                'description' => 'У нас вы можете заказать офигенный чай.',
                'image' => 'tea.png',
                'final' => 1
            ],
            [
                'parent_id' => null,
                'name' => 'Кофе',
                'table_name' => 'Coffee',
                'description' => 'У нас вы можете заказать офигенный кофе.',
                'image' => 'coffee.png',
                'final' => 1
            ]
        ]);*/
    }
}
