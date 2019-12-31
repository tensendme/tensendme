<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            'name' => 'Алматы',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
