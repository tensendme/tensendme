<?php

use App\Models\Profiles\City;
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
            'country_id' => 1,
        ]);
    }
}
