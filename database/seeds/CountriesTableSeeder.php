<?php

use Illuminate\Database\Seeder;
use \App\Models\Profiles\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Казахстан'
        ]);
    }
}
