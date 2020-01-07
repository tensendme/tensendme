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
            'name' => 'TestCourseCategory',
            'parent_category_id' => null,
            'category_type_id' => 1,
        ]);

        Category::insert([
            'name' => 'TestMeditationCategory',
            'parent_category_id' => null,
            'category_type_id' => 2,
        ]);
    }
}
