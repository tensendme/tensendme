<?php

use Illuminate\Database\Seeder;
use \App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            'name' => 'TestCategory',
            'created_at' => now(),
            'updated_at' => now(),
            'parent_category_id' => 0,
            'type' => 1,
        ]);
    }
}
