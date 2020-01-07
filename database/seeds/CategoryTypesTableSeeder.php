<?php

use Illuminate\Database\Seeder;
use \App\Models\Categories\CategoryType;

class CategoryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryType::create([
            'name' => 'Курс'
        ]);

        CategoryType::create([
            'name' => 'Медитация'
        ]);
    }
}
